<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rdcstarr\Locale\Models\Country;
use Rdcstarr\Locale\Models\Language;

final class CountryLanguageSeeder extends Seeder
{
    /**
     * Seed the country_language pivot with official language relationships.
     * Requires both LanguagesSeeder and CountriesSeeder to have run first.
     *
     * @return void
     */
    public function run(): void
    {
        $languageIds = Language::pluck('id', 'code');
        $countryIds  = Country::pluck('id', 'code');

        /**
         * Map of ISO 3166-1 alpha-2 country code → list of language relationships.
         * Each entry: ['language' => ISO 639-1 code, 'is_official' => bool]
         * Language codes not present in the languages table are silently skipped.
         *
         * @var array<string, list<array{language: string, is_official: bool}>>
         */
        $relationships = [
            // ── Europe ──────────────────────────────────────────────────────
            'AD' => [
                // Catalan (ca) is the only official language but not seeded;
                // Spanish and French are widely used by residents.
                ['language' => 'es', 'is_official' => false],
                ['language' => 'fr', 'is_official' => false],
            ],
            'AL' => [
                ['language' => 'sq', 'is_official' => true],
            ],
            'AT' => [
                ['language' => 'de', 'is_official' => true],
            ],
            'BA' => [
                ['language' => 'bs', 'is_official' => true],
                ['language' => 'hr', 'is_official' => true],
                ['language' => 'sr', 'is_official' => true],
            ],
            'BE' => [
                ['language' => 'nl', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'de', 'is_official' => true],
            ],
            'BG' => [
                ['language' => 'bg', 'is_official' => true],
            ],
            'BY' => [
                // Belarusian (be) not seeded; Russian is co-official.
                ['language' => 'ru', 'is_official' => true],
            ],
            'CH' => [
                ['language' => 'de', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'it', 'is_official' => true],
            ],
            'CY' => [
                ['language' => 'el', 'is_official' => true],
                ['language' => 'tr', 'is_official' => true],
            ],
            'CZ' => [
                ['language' => 'cs', 'is_official' => true],
            ],
            'DE' => [
                ['language' => 'de', 'is_official' => true],
            ],
            'DK' => [
                ['language' => 'da', 'is_official' => true],
            ],
            'EE' => [
                ['language' => 'et', 'is_official' => true],
            ],
            'ES' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'FI' => [
                ['language' => 'fi', 'is_official' => true],
                ['language' => 'sv', 'is_official' => true],
            ],
            'FR' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'GB' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'GR' => [
                ['language' => 'el', 'is_official' => true],
            ],
            'HR' => [
                ['language' => 'hr', 'is_official' => true],
            ],
            'HU' => [
                ['language' => 'hu', 'is_official' => true],
            ],
            'IE' => [
                // Irish (ga) is co-official but not seeded.
                ['language' => 'en', 'is_official' => true],
            ],
            'IS' => [
                // Icelandic (is) not seeded; English is widely understood.
                ['language' => 'en', 'is_official' => false],
            ],
            'IT' => [
                ['language' => 'it', 'is_official' => true],
            ],
            'LI' => [
                ['language' => 'de', 'is_official' => true],
            ],
            'LT' => [
                ['language' => 'lt', 'is_official' => true],
            ],
            'LU' => [
                // Luxembourgish (lb) not seeded.
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'de', 'is_official' => true],
            ],
            'LV' => [
                ['language' => 'lv', 'is_official' => true],
            ],
            'MC' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'MD' => [
                ['language' => 'ro', 'is_official' => true],
            ],
            'ME' => [
                ['language' => 'sr', 'is_official' => true],
                ['language' => 'bs', 'is_official' => true],
                ['language' => 'hr', 'is_official' => true],
                ['language' => 'sq', 'is_official' => true],
            ],
            'MK' => [
                ['language' => 'mk', 'is_official' => true],
                ['language' => 'sq', 'is_official' => true],
            ],
            'MT' => [
                ['language' => 'mt', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'NL' => [
                ['language' => 'nl', 'is_official' => true],
            ],
            'NO' => [
                ['language' => 'no', 'is_official' => true],
            ],
            'PL' => [
                ['language' => 'pl', 'is_official' => true],
            ],
            'PT' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'RO' => [
                ['language' => 'ro', 'is_official' => true],
            ],
            'RS' => [
                ['language' => 'sr', 'is_official' => true],
            ],
            'RU' => [
                ['language' => 'ru', 'is_official' => true],
            ],
            'SE' => [
                ['language' => 'sv', 'is_official' => true],
            ],
            'SI' => [
                ['language' => 'sl', 'is_official' => true],
            ],
            'SK' => [
                ['language' => 'sk', 'is_official' => true],
            ],
            'SM' => [
                ['language' => 'it', 'is_official' => true],
            ],
            'TR' => [
                ['language' => 'tr', 'is_official' => true],
            ],
            'UA' => [
                ['language' => 'uk', 'is_official' => true],
            ],
            'VA' => [
                ['language' => 'it', 'is_official' => true],
            ],

            // ── Americas ─────────────────────────────────────────────────────
            'AG' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'AR' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'BB' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'BO' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'BR' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'BS' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'BZ' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'CA' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
            ],
            'CL' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'CO' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'CR' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'CU' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'DM' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'DO' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'EC' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'GD' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'GT' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'GY' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'HN' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'HT' => [
                // Haitian Creole (ht) not seeded.
                ['language' => 'fr', 'is_official' => true],
            ],
            'JM' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'KN' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'LC' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'MX' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'NI' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'PA' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'PE' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'PY' => [
                // Guaraní (gn) is co-official but not seeded.
                ['language' => 'es', 'is_official' => true],
            ],
            'SR' => [
                ['language' => 'nl', 'is_official' => true],
            ],
            'SV' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'TT' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'US' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'UY' => [
                ['language' => 'es', 'is_official' => true],
            ],
            'VC' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'VE' => [
                ['language' => 'es', 'is_official' => true],
            ],

            // ── Africa ───────────────────────────────────────────────────────
            'AO' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'BF' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'BI' => [
                // Kirundi (rn) is co-official but not seeded.
                ['language' => 'fr', 'is_official' => true],
            ],
            'BJ' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'BW' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'CD' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'sw', 'is_official' => false],
            ],
            'CF' => [
                // Sango (sg) is co-official but not seeded.
                ['language' => 'fr', 'is_official' => true],
            ],
            'CG' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'CI' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'CM' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'CV' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'DJ' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'ar', 'is_official' => true],
            ],
            'DZ' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'EG' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'ER' => [
                // Tigrinya (ti) not seeded.
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'ET' => [
                ['language' => 'am', 'is_official' => true],
            ],
            'GA' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'GH' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'GM' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'GN' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'GQ' => [
                ['language' => 'es', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'pt', 'is_official' => true],
            ],
            'GW' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'KE' => [
                ['language' => 'sw', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'KM' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
            ],
            'LR' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'LS' => [
                // Sesotho (st) not seeded.
                ['language' => 'en', 'is_official' => true],
            ],
            'LY' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'MA' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'MG' => [
                // Malagasy (mg) not seeded.
                ['language' => 'fr', 'is_official' => true],
            ],
            'ML' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'MR' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'MU' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'MW' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'MZ' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'NA' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'af', 'is_official' => false],
            ],
            'NE' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'NG' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'yo', 'is_official' => false],
            ],
            'RW' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'sw', 'is_official' => true],
            ],
            'SC' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'SD' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'SL' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'SN' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'SO' => [
                ['language' => 'so', 'is_official' => true],
                ['language' => 'ar', 'is_official' => true],
            ],
            'SS' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'ST' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'SZ' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'TD' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'ar', 'is_official' => true],
            ],
            'TG' => [
                ['language' => 'fr', 'is_official' => true],
            ],
            'TN' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'TZ' => [
                ['language' => 'sw', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'UG' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'sw', 'is_official' => true],
            ],
            'ZA' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'af', 'is_official' => true],
            ],
            'ZM' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'ZW' => [
                ['language' => 'en', 'is_official' => true],
            ],

            // ── Middle East ──────────────────────────────────────────────────
            'AE' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'BH' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'IL' => [
                ['language' => 'he', 'is_official' => true],
                ['language' => 'ar', 'is_official' => false],
            ],
            'IQ' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'ku', 'is_official' => true],
            ],
            'IR' => [
                ['language' => 'fa', 'is_official' => true],
            ],
            'JO' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'KW' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'LB' => [
                ['language' => 'ar', 'is_official' => true],
                ['language' => 'fr', 'is_official' => false],
            ],
            'OM' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'PS' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'QA' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'SA' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'SY' => [
                ['language' => 'ar', 'is_official' => true],
            ],
            'YE' => [
                ['language' => 'ar', 'is_official' => true],
            ],

            // ── Asia & Oceania ────────────────────────────────────────────────
            'AF' => [
                ['language' => 'fa', 'is_official' => true],
                ['language' => 'ps', 'is_official' => true],
            ],
            'AM' => [
                ['language' => 'hy', 'is_official' => true],
            ],
            'AU' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'AZ' => [
                ['language' => 'az', 'is_official' => true],
            ],
            'BD' => [
                ['language' => 'bn', 'is_official' => true],
            ],
            'BN' => [
                ['language' => 'ms', 'is_official' => true],
            ],
            'BT' => [
                // Dzongkha (dz) not seeded.
                ['language' => 'en', 'is_official' => false],
            ],
            'CN' => [
                ['language' => 'zh', 'is_official' => true],
            ],
            'FJ' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'hi', 'is_official' => true],
            ],
            'FM' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'GE' => [
                ['language' => 'ka', 'is_official' => true],
            ],
            'ID' => [
                ['language' => 'id', 'is_official' => true],
            ],
            'IN' => [
                ['language' => 'hi', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
                ['language' => 'bn', 'is_official' => true],
                ['language' => 'te', 'is_official' => true],
                ['language' => 'mr', 'is_official' => true],
                ['language' => 'ta', 'is_official' => true],
                ['language' => 'ur', 'is_official' => true],
                ['language' => 'gu', 'is_official' => true],
                ['language' => 'kn', 'is_official' => true],
                ['language' => 'ml', 'is_official' => true],
                ['language' => 'pa', 'is_official' => true],
                ['language' => 'ne', 'is_official' => true],
            ],
            'JP' => [
                ['language' => 'ja', 'is_official' => true],
            ],
            'KG' => [
                // Kyrgyz (ky) not seeded; Russian is co-official.
                ['language' => 'ru', 'is_official' => true],
            ],
            'KH' => [
                ['language' => 'km', 'is_official' => true],
            ],
            'KI' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'KP' => [
                ['language' => 'ko', 'is_official' => true],
            ],
            'KR' => [
                ['language' => 'ko', 'is_official' => true],
            ],
            'KZ' => [
                ['language' => 'kk', 'is_official' => true],
                ['language' => 'ru', 'is_official' => true],
            ],
            'LA' => [
                ['language' => 'lo', 'is_official' => true],
            ],
            'LK' => [
                ['language' => 'si', 'is_official' => true],
                ['language' => 'ta', 'is_official' => true],
            ],
            'MH' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'MM' => [
                ['language' => 'my', 'is_official' => true],
            ],
            'MN' => [
                ['language' => 'mn', 'is_official' => true],
            ],
            'MV' => [
                // Dhivehi (dv) not seeded.
                ['language' => 'en', 'is_official' => false],
            ],
            'MY' => [
                ['language' => 'ms', 'is_official' => true],
            ],
            'NP' => [
                ['language' => 'ne', 'is_official' => true],
            ],
            'NR' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'NZ' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'PG' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'PH' => [
                ['language' => 'tl', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'PK' => [
                ['language' => 'ur', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'PW' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'SB' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'SG' => [
                ['language' => 'en', 'is_official' => true],
                ['language' => 'ms', 'is_official' => true],
                ['language' => 'zh', 'is_official' => true],
                ['language' => 'ta', 'is_official' => true],
            ],
            'TH' => [
                ['language' => 'th', 'is_official' => true],
            ],
            'TJ' => [
                // Tajik (tg) not seeded; Russian is the inter-ethnic language.
                ['language' => 'ru', 'is_official' => false],
            ],
            'TL' => [
                ['language' => 'pt', 'is_official' => true],
            ],
            'TM' => [
                // Turkmen (tk) not seeded.
                ['language' => 'ru', 'is_official' => false],
            ],
            'TO' => [
                // Tongan (to) not seeded.
                ['language' => 'en', 'is_official' => false],
            ],
            'TV' => [
                ['language' => 'en', 'is_official' => true],
            ],
            'TW' => [
                ['language' => 'zh', 'is_official' => true],
            ],
            'UZ' => [
                ['language' => 'uz', 'is_official' => true],
            ],
            'VN' => [
                ['language' => 'vi', 'is_official' => true],
            ],
            'VU' => [
                ['language' => 'fr', 'is_official' => true],
                ['language' => 'en', 'is_official' => true],
            ],
            'WS' => [
                ['language' => 'en', 'is_official' => false],
            ],
        ];

        collect($relationships)->each(function (array $languages, string $countryCode) use ($languageIds, $countryIds)
        {
            $countryId = $countryIds[$countryCode] ?? null;

            if (blank($countryId))
            {
                return;
            }

            collect($languages)->each(function (array $entry) use ($countryId, $languageIds)
            {
                $languageId = $languageIds[$entry['language']] ?? null;

                if (blank($languageId))
                {
                    return;
                }

                DB::table('country_language')->insert([
                    'country_id'  => $countryId,
                    'language_id' => $languageId,
                    'is_official' => $entry['is_official'],
                ]);
            });
        });
    }
}
