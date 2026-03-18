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
            ['name' => 'Afrikaans',    'code' => 'af', 'enabled' => false, 'default' => false],
            ['name' => 'Albanian',     'code' => 'sq', 'enabled' => false, 'default' => false],
            ['name' => 'Amharic',      'code' => 'am', 'enabled' => false, 'default' => false],
            ['name' => 'Arabic',       'code' => 'ar', 'enabled' => false, 'default' => false],
            ['name' => 'Armenian',     'code' => 'hy', 'enabled' => false, 'default' => false],
            ['name' => 'Azerbaijani',  'code' => 'az', 'enabled' => false, 'default' => false],
            ['name' => 'Bengali',      'code' => 'bn', 'enabled' => false, 'default' => false],
            ['name' => 'Bosnian',      'code' => 'bs', 'enabled' => false, 'default' => false],
            ['name' => 'Bulgarian',    'code' => 'bg', 'enabled' => false, 'default' => false],
            ['name' => 'Burmese',      'code' => 'my', 'enabled' => false, 'default' => false],
            ['name' => 'Chinese',      'code' => 'zh', 'enabled' => false, 'default' => false],
            ['name' => 'Croatian',     'code' => 'hr', 'enabled' => false, 'default' => false],
            ['name' => 'Czech',        'code' => 'cs', 'enabled' => false, 'default' => false],
            ['name' => 'Danish',       'code' => 'da', 'enabled' => false, 'default' => false],
            ['name' => 'Dutch',        'code' => 'nl', 'enabled' => false, 'default' => false],
            ['name' => 'English',      'code' => 'en', 'enabled' => true,  'default' => true],
            ['name' => 'Estonian',     'code' => 'et', 'enabled' => false, 'default' => false],
            ['name' => 'Filipino',     'code' => 'tl', 'enabled' => false, 'default' => false],
            ['name' => 'Finnish',      'code' => 'fi', 'enabled' => false, 'default' => false],
            ['name' => 'French',       'code' => 'fr', 'enabled' => false, 'default' => false],
            ['name' => 'Georgian',     'code' => 'ka', 'enabled' => false, 'default' => false],
            ['name' => 'German',       'code' => 'de', 'enabled' => false, 'default' => false],
            ['name' => 'Greek',        'code' => 'el', 'enabled' => false, 'default' => false],
            ['name' => 'Gujarati',     'code' => 'gu', 'enabled' => false, 'default' => false],
            ['name' => 'Hebrew',       'code' => 'he', 'enabled' => false, 'default' => false],
            ['name' => 'Hindi',        'code' => 'hi', 'enabled' => false, 'default' => false],
            ['name' => 'Hungarian',    'code' => 'hu', 'enabled' => false, 'default' => false],
            ['name' => 'Indonesian',   'code' => 'id', 'enabled' => false, 'default' => false],
            ['name' => 'Italian',      'code' => 'it', 'enabled' => false, 'default' => false],
            ['name' => 'Japanese',     'code' => 'ja', 'enabled' => false, 'default' => false],
            ['name' => 'Kannada',      'code' => 'kn', 'enabled' => false, 'default' => false],
            ['name' => 'Kazakh',       'code' => 'kk', 'enabled' => false, 'default' => false],
            ['name' => 'Khmer',        'code' => 'km', 'enabled' => false, 'default' => false],
            ['name' => 'Korean',       'code' => 'ko', 'enabled' => false, 'default' => false],
            ['name' => 'Kurdish',      'code' => 'ku', 'enabled' => false, 'default' => false],
            ['name' => 'Lao',          'code' => 'lo', 'enabled' => false, 'default' => false],
            ['name' => 'Latvian',      'code' => 'lv', 'enabled' => false, 'default' => false],
            ['name' => 'Lithuanian',   'code' => 'lt', 'enabled' => false, 'default' => false],
            ['name' => 'Macedonian',   'code' => 'mk', 'enabled' => false, 'default' => false],
            ['name' => 'Malay',        'code' => 'ms', 'enabled' => false, 'default' => false],
            ['name' => 'Malayalam',    'code' => 'ml', 'enabled' => false, 'default' => false],
            ['name' => 'Maltese',      'code' => 'mt', 'enabled' => false, 'default' => false],
            ['name' => 'Marathi',      'code' => 'mr', 'enabled' => false, 'default' => false],
            ['name' => 'Mongolian',    'code' => 'mn', 'enabled' => false, 'default' => false],
            ['name' => 'Nepali',       'code' => 'ne', 'enabled' => false, 'default' => false],
            ['name' => 'Norwegian',    'code' => 'no', 'enabled' => false, 'default' => false],
            ['name' => 'Pashto',       'code' => 'ps', 'enabled' => false, 'default' => false],
            ['name' => 'Persian',      'code' => 'fa', 'enabled' => false, 'default' => false],
            ['name' => 'Polish',       'code' => 'pl', 'enabled' => false, 'default' => false],
            ['name' => 'Portuguese',   'code' => 'pt', 'enabled' => false, 'default' => false],
            ['name' => 'Punjabi',      'code' => 'pa', 'enabled' => false, 'default' => false],
            ['name' => 'Romanian',     'code' => 'ro', 'enabled' => false, 'default' => false],
            ['name' => 'Russian',      'code' => 'ru', 'enabled' => false, 'default' => false],
            ['name' => 'Serbian',      'code' => 'sr', 'enabled' => false, 'default' => false],
            ['name' => 'Sinhala',      'code' => 'si', 'enabled' => false, 'default' => false],
            ['name' => 'Slovak',       'code' => 'sk', 'enabled' => false, 'default' => false],
            ['name' => 'Slovenian',    'code' => 'sl', 'enabled' => false, 'default' => false],
            ['name' => 'Somali',       'code' => 'so', 'enabled' => false, 'default' => false],
            ['name' => 'Spanish',      'code' => 'es', 'enabled' => false, 'default' => false],
            ['name' => 'Swahili',      'code' => 'sw', 'enabled' => false, 'default' => false],
            ['name' => 'Swedish',      'code' => 'sv', 'enabled' => false, 'default' => false],
            ['name' => 'Tamil',        'code' => 'ta', 'enabled' => false, 'default' => false],
            ['name' => 'Telugu',       'code' => 'te', 'enabled' => false, 'default' => false],
            ['name' => 'Thai',         'code' => 'th', 'enabled' => false, 'default' => false],
            ['name' => 'Turkish',      'code' => 'tr', 'enabled' => false, 'default' => false],
            ['name' => 'Ukrainian',    'code' => 'uk', 'enabled' => false, 'default' => false],
            ['name' => 'Urdu',         'code' => 'ur', 'enabled' => false, 'default' => false],
            ['name' => 'Uzbek',        'code' => 'uz', 'enabled' => false, 'default' => false],
            ['name' => 'Vietnamese',   'code' => 'vi', 'enabled' => false, 'default' => false],
            ['name' => 'Yoruba',       'code' => 'yo', 'enabled' => false, 'default' => false],
        ];

        collect($languages)->each(function (array $language)
        {
            Language::create($language);
        });
    }
}
