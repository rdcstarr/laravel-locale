<?php

declare(strict_types=1);

use Rdcstarr\Locale\TranslationService;

if (!function_exists('loc'))
{
    /**
     * Translate a key using database translations.
     * Equivalent to Laravel's __() but backed by the translations table.
     *
     * Include 'count' in $replace to automatically select singular or plural form.
     * Value format: "singular|plural", e.g. "One item|:count items".
     *
     * @param  string               $key
     * @param  array<string, mixed> $replace
     * @param  string|null          $locale   Defaults to app()->getLocale()
     * @return string
     */
    function loc(string $key, array $replace = [], ?string $locale = null): string
    {
        return app(TranslationService::class)->trans($key, $replace, $locale);
    }
}
