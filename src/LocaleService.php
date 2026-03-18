<?php

declare(strict_types=1);

namespace Rdcstarr\Locale;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Rdcstarr\Locale\Models\Country;
use Rdcstarr\Locale\Models\Language;

final class LocaleService
{
    /**
     * Return all enabled languages.
     *
     * @return Collection<int, Language>
     */
    public function enabledLanguages(): Collection
    {
        return Language::enabled()->get();
    }

    /**
     * Return the default language, or null if none is set.
     *
     * @return Language|null
     */
    public function defaultLanguage(): ?Language
    {
        return Language::defaultLanguage();
    }

    /**
     * Find a language by its ISO 639-1 code.
     *
     * @param  string        $code
     * @return Language|null
     */
    public function languageByCode(string $code): ?Language
    {
        return Language::where('code', Str::lower($code))->first();
    }

    /**
     * Return a code → id map for all enabled languages.
     *
     * @return Collection<string, int>
     */
    public function enabledLanguageCodeToId(): Collection
    {
        return Language::enabledCodeToId();
    }

    /**
     * Return a Language query builder for custom queries.
     *
     * @return Builder<Language>
     */
    public function languages(): Builder
    {
        return Language::query();
    }

    /**
     * Find a country by its ISO 3166-1 alpha-2 code.
     *
     * @param  string       $code
     * @return Country|null
     */
    public function countryByCode(string $code): ?Country
    {
        return Country::findByCode($code);
    }

    /**
     * Return a code → id map for all countries.
     *
     * @return Collection<string, int>
     */
    public function countryCodeToId(): Collection
    {
        return Country::codeToId();
    }

    /**
     * Return all countries that use a given language code.
     *
     * @param  string                $languageCode
     * @return Collection<int, Country>
     */
    public function countriesForLanguage(string $languageCode): Collection
    {
        return Country::forLanguage($languageCode)->get();
    }

    /**
     * Return a Country query builder for custom queries.
     *
     * @return Builder<Country>
     */
    public function countries(): Builder
    {
        return Country::query();
    }
}
