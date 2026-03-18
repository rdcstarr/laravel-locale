<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;
use Rdcstarr\Locale\LocaleService;
use Rdcstarr\Locale\Models\Country;
use Rdcstarr\Locale\Models\Language;

/**
 * @method static Collection<int, Language>  enabledLanguages()
 * @method static Language|null              defaultLanguage()
 * @method static Language|null              languageByCode(string $code)
 * @method static Collection<string, int>   enabledLanguageCodeToId()
 * @method static Builder<Language>          languages()
 * @method static Country|null              countryByCode(string $code)
 * @method static Collection<string, int>   countryCodeToId()
 * @method static Collection<int, Country>  countriesForLanguage(string $languageCode)
 * @method static Builder<Country>          countries()
 *
 * @see LocaleService
 */
final class Locale extends Facade
{
    /**
     * Return the facade accessor key bound in the container.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return LocaleService::class;
    }
}
