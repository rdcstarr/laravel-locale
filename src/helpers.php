<?php

declare(strict_types=1);

use Rdcstarr\Locale\LocaleService;
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

if (!function_exists('country_calling_code'))
{
    /**
     * Return the ITU-T E.164 calling code for a country (e.g. "+40"), or null if unknown.
     *
     * @param  string      $code ISO 3166-1 alpha-2, case-insensitive
     * @return string|null
     */
    function country_calling_code(string $code): ?string
    {
        return app(LocaleService::class)->callingCodeByCode($code);
    }
}
