<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Facades;

use Illuminate\Support\Facades\Facade;
use Rdcstarr\Locale\Models\Translation;
use Rdcstarr\Locale\TranslationService;

/**
 * @method static string      trans(string $key, array $replace = [], string|null $locale = null)
 * @method static Translation set(string $key, string $value, string $locale)
 * @method static void        setMany(array $translations, string $locale)
 * @method static void        flushLocale(string $locale)
 *
 * @see TranslationService
 */
final class Translate extends Facade
{
    /**
     * Return the facade accessor key bound in the container.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return TranslationService::class;
    }
}
