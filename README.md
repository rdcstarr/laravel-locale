# laravel-locale

Database-driven language and country management for Laravel 13.

- **Languages** — ISO 639-1, enabled/default flags
- **Countries** — ISO 3166-1 alpha-2, flag emoji, timezone, E.164 calling code, primary language
- **Octane-safe** — stateless singleton service, current locale read dynamically per request

---

## Requirements

| Dependency | Version |
| ---------- | ------- |
| PHP        | ^8.3    |
| Laravel    | ^13.0   |

---

## Installation

```bash
composer require rdcstarr/laravel-locale
```

Run the install command to publish and run migrations, then seed languages, countries and their relationships:

```bash
php artisan locale:install
```

### Manual installation

If you prefer to control the process yourself, publish the migrations without running the install command:

```bash
php artisan vendor:publish --tag=laravel-locale-migrations
```

Then run the migrations and seed the reference data:

```bash
php artisan migrate
php artisan db:seed --class="Rdcstarr\Locale\Database\Seeders\LanguagesSeeder"
php artisan db:seed --class="Rdcstarr\Locale\Database\Seeders\CountriesSeeder"
php artisan db:seed --class="Rdcstarr\Locale\Database\Seeders\CountryLanguageSeeder"
```

> **Note:** Migrations run automatically without publishing — skip `vendor:publish` if you do not need to modify the migration files.

---

## Languages

```php
use Locale;

// All enabled languages
Locale::enabledLanguages();

// Default language
Locale::defaultLanguage();

// Find by ISO 639-1 code
Locale::languageByCode('ro');

// code → id map (useful for seeding)
Locale::enabledLanguageCodeToId();

// Raw query builder
Locale::languages()->where('enabled', true)->get();
```

---

## Countries

```php
use Locale;

// Find by ISO 3166-1 alpha-2 code
Locale::countryByCode('RO');

// Phone prefix (ITU-T E.164, e.g. "+40")
Locale::callingCodeByCode('RO');     // → "+40"
country_calling_code('RO');          // → "+40"  (global helper)
Locale::countryByCode('RO')->calling_code;  // direct model access

// All countries sharing a calling code (e.g. NANP "+1")
Locale::countries()->byCallingCode('+1')->get();

// All countries that use a given language
Locale::countriesForLanguage('ro');

// code → id map (useful for seeding)
Locale::countryCodeToId();

// Raw query builder
Locale::countries()->with('primaryLanguage')->get();
```

---

## Models

### `Language`

| Column    | Type      | Notes                |
| --------- | --------- | -------------------- |
| `id`      | bigint    |                      |
| `name`    | string    | e.g. `Romanian`      |
| `code`    | string(5) | ISO 639-1, e.g. `ro` |
| `enabled` | boolean   | default `true`       |
| `default` | boolean   | default `false`      |

### `Country`

| Column                | Type           | Notes                         |
| --------------------- | -------------- | ----------------------------- |
| `id`                  | bigint         |                               |
| `name`                | string         | e.g. `Romania`                |
| `code`                | string(2)      | ISO 3166-1 alpha-2, e.g. `RO` |
| `flag`                | string         | URL or path                   |
| `flag_emoji`          | string         | e.g. `🇷🇴`                     |
| `timezone`            | string         | e.g. `Europe/Bucharest`       |
| `calling_code`        | string(10)     | ITU-T E.164, e.g. `+40`, `+1` |
| `primary_language_id` | FK → languages |                               |

The `country_language` pivot table stores all official languages per country with an `is_official` boolean.

---

## Octane compatibility

`LocaleService` is registered as a singleton but stores no request-scoped state — the current locale is always read dynamically via `app()->getLocale()`, so it is safe to reuse across requests on a long-lived worker.

---
