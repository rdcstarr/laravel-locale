<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Database\Seeders;

use Illuminate\Database\Seeder;
use Rdcstarr\Locale\Models\Language;

final class LanguagesSeeder extends Seeder
{
    /**
     * Seed the languages table with ISO 639-1 languages.
     *
     * @return void
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'Afrikaans',    'code' => 'af', 'flag_country_code' => 'ZA', 'enabled' => false, 'default' => false],
            ['name' => 'Albanian',     'code' => 'sq', 'flag_country_code' => 'AL', 'enabled' => false, 'default' => false],
            ['name' => 'Amharic',      'code' => 'am', 'flag_country_code' => 'ET', 'enabled' => false, 'default' => false],
            ['name' => 'Arabic',       'code' => 'ar', 'flag_country_code' => 'SA', 'enabled' => false, 'default' => false],
            ['name' => 'Armenian',     'code' => 'hy', 'flag_country_code' => 'AM', 'enabled' => false, 'default' => false],
            ['name' => 'Azerbaijani',  'code' => 'az', 'flag_country_code' => 'AZ', 'enabled' => false, 'default' => false],
            ['name' => 'Bengali',      'code' => 'bn', 'flag_country_code' => 'BD', 'enabled' => false, 'default' => false],
            ['name' => 'Bosnian',      'code' => 'bs', 'flag_country_code' => 'BA', 'enabled' => false, 'default' => false],
            ['name' => 'Bulgarian',    'code' => 'bg', 'flag_country_code' => 'BG', 'enabled' => false, 'default' => false],
            ['name' => 'Burmese',      'code' => 'my', 'flag_country_code' => 'MM', 'enabled' => false, 'default' => false],
            ['name' => 'Chinese',      'code' => 'zh', 'flag_country_code' => 'CN', 'enabled' => false, 'default' => false],
            ['name' => 'Croatian',     'code' => 'hr', 'flag_country_code' => 'HR', 'enabled' => false, 'default' => false],
            ['name' => 'Czech',        'code' => 'cs', 'flag_country_code' => 'CZ', 'enabled' => false, 'default' => false],
            ['name' => 'Danish',       'code' => 'da', 'flag_country_code' => 'DK', 'enabled' => false, 'default' => false],
            ['name' => 'Dutch',        'code' => 'nl', 'flag_country_code' => 'NL', 'enabled' => false, 'default' => false],
            ['name' => 'English',      'code' => 'en', 'flag_country_code' => 'GB', 'enabled' => true,  'default' => true],
            ['name' => 'Estonian',     'code' => 'et', 'flag_country_code' => 'EE', 'enabled' => false, 'default' => false],
            ['name' => 'Filipino',     'code' => 'tl', 'flag_country_code' => 'PH', 'enabled' => false, 'default' => false],
            ['name' => 'Finnish',      'code' => 'fi', 'flag_country_code' => 'FI', 'enabled' => false, 'default' => false],
            ['name' => 'French',       'code' => 'fr', 'flag_country_code' => 'FR', 'enabled' => false, 'default' => false],
            ['name' => 'Georgian',     'code' => 'ka', 'flag_country_code' => 'GE', 'enabled' => false, 'default' => false],
            ['name' => 'German',       'code' => 'de', 'flag_country_code' => 'DE', 'enabled' => false, 'default' => false],
            ['name' => 'Greek',        'code' => 'el', 'flag_country_code' => 'GR', 'enabled' => false, 'default' => false],
            ['name' => 'Gujarati',     'code' => 'gu', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Hebrew',       'code' => 'he', 'flag_country_code' => 'IL', 'enabled' => false, 'default' => false],
            ['name' => 'Hindi',        'code' => 'hi', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Hungarian',    'code' => 'hu', 'flag_country_code' => 'HU', 'enabled' => false, 'default' => false],
            ['name' => 'Indonesian',   'code' => 'id', 'flag_country_code' => 'ID', 'enabled' => false, 'default' => false],
            ['name' => 'Italian',      'code' => 'it', 'flag_country_code' => 'IT', 'enabled' => false, 'default' => false],
            ['name' => 'Japanese',     'code' => 'ja', 'flag_country_code' => 'JP', 'enabled' => false, 'default' => false],
            ['name' => 'Kannada',      'code' => 'kn', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Kazakh',       'code' => 'kk', 'flag_country_code' => 'KZ', 'enabled' => false, 'default' => false],
            ['name' => 'Khmer',        'code' => 'km', 'flag_country_code' => 'KH', 'enabled' => false, 'default' => false],
            ['name' => 'Korean',       'code' => 'ko', 'flag_country_code' => 'KR', 'enabled' => false, 'default' => false],
            ['name' => 'Kurdish',      'code' => 'ku', 'flag_country_code' => 'IQ', 'enabled' => false, 'default' => false],
            ['name' => 'Lao',          'code' => 'lo', 'flag_country_code' => 'LA', 'enabled' => false, 'default' => false],
            ['name' => 'Latvian',      'code' => 'lv', 'flag_country_code' => 'LV', 'enabled' => false, 'default' => false],
            ['name' => 'Lithuanian',   'code' => 'lt', 'flag_country_code' => 'LT', 'enabled' => false, 'default' => false],
            ['name' => 'Macedonian',   'code' => 'mk', 'flag_country_code' => 'MK', 'enabled' => false, 'default' => false],
            ['name' => 'Malay',        'code' => 'ms', 'flag_country_code' => 'MY', 'enabled' => false, 'default' => false],
            ['name' => 'Malayalam',    'code' => 'ml', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Maltese',      'code' => 'mt', 'flag_country_code' => 'MT', 'enabled' => false, 'default' => false],
            ['name' => 'Marathi',      'code' => 'mr', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Mongolian',    'code' => 'mn', 'flag_country_code' => 'MN', 'enabled' => false, 'default' => false],
            ['name' => 'Nepali',       'code' => 'ne', 'flag_country_code' => 'NP', 'enabled' => false, 'default' => false],
            ['name' => 'Norwegian',    'code' => 'no', 'flag_country_code' => 'NO', 'enabled' => false, 'default' => false],
            ['name' => 'Pashto',       'code' => 'ps', 'flag_country_code' => 'AF', 'enabled' => false, 'default' => false],
            ['name' => 'Persian',      'code' => 'fa', 'flag_country_code' => 'IR', 'enabled' => false, 'default' => false],
            ['name' => 'Polish',       'code' => 'pl', 'flag_country_code' => 'PL', 'enabled' => false, 'default' => false],
            ['name' => 'Portuguese',   'code' => 'pt', 'flag_country_code' => 'PT', 'enabled' => false, 'default' => false],
            ['name' => 'Punjabi',      'code' => 'pa', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Romanian',     'code' => 'ro', 'flag_country_code' => 'RO', 'enabled' => false, 'default' => false],
            ['name' => 'Russian',      'code' => 'ru', 'flag_country_code' => 'RU', 'enabled' => false, 'default' => false],
            ['name' => 'Serbian',      'code' => 'sr', 'flag_country_code' => 'RS', 'enabled' => false, 'default' => false],
            ['name' => 'Sinhala',      'code' => 'si', 'flag_country_code' => 'LK', 'enabled' => false, 'default' => false],
            ['name' => 'Slovak',       'code' => 'sk', 'flag_country_code' => 'SK', 'enabled' => false, 'default' => false],
            ['name' => 'Slovenian',    'code' => 'sl', 'flag_country_code' => 'SI', 'enabled' => false, 'default' => false],
            ['name' => 'Somali',       'code' => 'so', 'flag_country_code' => 'SO', 'enabled' => false, 'default' => false],
            ['name' => 'Spanish',      'code' => 'es', 'flag_country_code' => 'ES', 'enabled' => false, 'default' => false],
            ['name' => 'Swahili',      'code' => 'sw', 'flag_country_code' => 'KE', 'enabled' => false, 'default' => false],
            ['name' => 'Swedish',      'code' => 'sv', 'flag_country_code' => 'SE', 'enabled' => false, 'default' => false],
            ['name' => 'Tamil',        'code' => 'ta', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Telugu',       'code' => 'te', 'flag_country_code' => 'IN', 'enabled' => false, 'default' => false],
            ['name' => 'Thai',         'code' => 'th', 'flag_country_code' => 'TH', 'enabled' => false, 'default' => false],
            ['name' => 'Turkish',      'code' => 'tr', 'flag_country_code' => 'TR', 'enabled' => false, 'default' => false],
            ['name' => 'Ukrainian',    'code' => 'uk', 'flag_country_code' => 'UA', 'enabled' => false, 'default' => false],
            ['name' => 'Urdu',         'code' => 'ur', 'flag_country_code' => 'PK', 'enabled' => false, 'default' => false],
            ['name' => 'Uzbek',        'code' => 'uz', 'flag_country_code' => 'UZ', 'enabled' => false, 'default' => false],
            ['name' => 'Vietnamese',   'code' => 'vi', 'flag_country_code' => 'VN', 'enabled' => false, 'default' => false],
            ['name' => 'Yoruba',       'code' => 'yo', 'flag_country_code' => 'NG', 'enabled' => false, 'default' => false],
        ];

        collect($languages)->each(function (array $language)
        {
            Language::create($language);
        });
    }
}
