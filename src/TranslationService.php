<?php

declare(strict_types=1);

namespace Rdcstarr\Locale;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rdcstarr\Locale\Models\Translation;

/**
 * Database-driven translation service, compatible with Laravel Octane.
 *
 * On the first call for any key in a given locale, ALL translations for that
 * locale are fetched from the database in a single query and stored in:
 *   1. Laravel Cache (persistent across requests / processes)
 *   2. An in-memory array on this singleton (zero overhead in subsequent
 *      requests within the same Octane worker)
 *
 * This guarantees exactly one DB query per locale per process lifetime —
 * no N+1 regardless of how many groups or keys are used on a page.
 *
 * Plural forms are handled automatically when a 'count' key is present in
 * $replace. Value format: "singular|plural", e.g. "One item|:count items".
 *
 * When a Translation model is saved or deleted, the InvalidateTranslationCache
 * listener calls flushLocale() to invalidate both layers automatically.
 */
final class TranslationService
{
    /**
     * In-memory cache keyed by locale.
     * Structure: locale → group → key → value
     *
     * @var array<string, array<string, array<string, string>>>
     */
    private array $loaded = [];

    /**
     * Look up a translation key for the current (or given) locale.
     * Falls back to the raw key if no translation exists.
     *
     * Format: "group.key" or just "key" (stored under group "*").
     * Replacements: pass ['name' => 'Ana'] to replace :name in the value.
     * Plural: include 'count' in $replace to select singular or plural form.
     *         Value format: "singular|plural", e.g. "One item|:count items".
     *
     * @param  string               $key
     * @param  array<string, mixed> $replace
     * @param  string|null          $locale
     * @return string
     */
    public function trans(string $key, array $replace = [], ?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        [$group, $item] = $this->parseKey($key);

        $this->loadLocale($locale);

        $value = $this->loaded[$locale][$group][$item] ?? $key;

        if (array_key_exists('count', $replace))
        {
            $value = $this->choosePluralForm($value, (int) $replace['count']);
        }

        return $this->applyReplacements($value, $replace);
    }

    /**
     * Upsert a single translation into the database.
     * The cache for the affected locale is invalidated automatically
     * via the InvalidateTranslationCache listener when the model is saved.
     *
     * @param  string $key    Dotted key, e.g. "messages.welcome" or "welcome"
     * @param  string $value  The translated string
     * @param  string $locale ISO 639-1 code, e.g. "en", "ro"
     * @return Translation
     */
    public function set(string $key, string $value, string $locale): Translation
    {
        [$group, $item] = $this->parseKey($key);

        return Translation::updateOrCreate(
            ['group' => $group, 'key' => $item, 'language_code' => $locale],
            ['value' => $value],
        );
    }

    /**
     * Bulk-upsert multiple translations for a single locale.
     * Uses a single INSERT ... ON DUPLICATE KEY UPDATE query.
     * Listener events are NOT fired per row; cache is flushed once at the end.
     *
     * @param  array<string, string> $translations  Key-value map, e.g. ['messages.welcome' => 'Bun venit']
     * @param  string                $locale        ISO 639-1 code, e.g. "ro"
     * @return void
     */
    public function setMany(array $translations, string $locale): void
    {
        $rows = collect($translations)
            ->map(function (string $value, string $key) use ($locale)
            {
                [$group, $item] = $this->parseKey($key);

                return ['group' => $group, 'key' => $item, 'language_code' => $locale, 'value' => $value];
            })
            ->values()
            ->all();

        Translation::upsert($rows, ['group', 'key', 'language_code'], ['value']);

        $this->flushLocale($locale);
    }

    /**
     * Flush the in-memory and persistent cache for an entire locale.
     * Called automatically by the InvalidateTranslationCache listener.
     *
     * @param  string $locale
     * @return void
     */
    public function flushLocale(string $locale): void
    {
        unset($this->loaded[$locale]);

        Cache::forget("locale_translations.{$locale}");
    }

    /**
     * Load all translations for a locale in one query, if not already loaded.
     * Result is stored in both Laravel Cache and the in-memory array.
     *
     * @param  string $locale
     * @return void
     */
    private function loadLocale(string $locale): void
    {
        if (isset($this->loaded[$locale]))
        {
            return;
        }

        $this->loaded[$locale] = Cache::rememberForever(
            "locale_translations.{$locale}",
            fn () => Translation::query()
                ->forLocale($locale)
                ->get(['group', 'key', 'value'])
                ->groupBy('group')
                ->map(fn ($rows) => $rows->pluck('value', 'key')->all())
                ->all(),
        );
    }

    /**
     * Parse a dotted key into [group, item].
     * Keys without a dot are placed in the "*" group.
     *
     * @param  string        $key
     * @return array{0: string, 1: string}
     */
    private function parseKey(string $key): array
    {
        if (Str::contains($key, '.'))
        {
            [$group, $item] = explode('.', $key, 2);

            return [$group, $item];
        }

        return ['*', $key];
    }

    /**
     * Replace :placeholder tokens in a string with the given values.
     *
     * @param  string               $value
     * @param  array<string, mixed> $replace
     * @return string
     */
    private function applyReplacements(string $value, array $replace): string
    {
        if (blank($replace))
        {
            return $value;
        }

        return collect($replace)->reduce(
            fn (string $carry, mixed $val, string $placeholder) =>
                Str::replace(":{$placeholder}", (string) $val, $carry),
            $value,
        );
    }

    /**
     * Choose the singular or plural form from a pipe-delimited string.
     *
     * @param  string $value
     * @param  int    $count
     * @return string
     */
    private function choosePluralForm(string $value, int $count): string
    {
        $parts = explode('|', $value, 2);

        if (count($parts) === 1)
        {
            return $value;
        }

        return $count === 1 ? $parts[0] : $parts[1];
    }
}
