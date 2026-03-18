# laravel-locale

Database-driven language, country and translation management for Laravel 12.

- **Languages** — ISO 639-1, enabled/default flags
- **Countries** — ISO 3166-1 alpha-2, flag emoji, timezone, primary language
- **Translations** — database-backed `loc()` helper, equivalent to Laravel's `__()`
- **Octane-safe** — single DB query per locale per worker lifetime, in-memory + persistent cache

---

## Requirements

| Dependency | Version |
|---|---|
| PHP | ^8.3 |
| Laravel | ^12.0 |

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

## Translations

### The `loc()` helper

`loc()` is the database-backed equivalent of Laravel's `__()`.

```php
// Simple lookup
loc('messages.welcome')

// With replacements
loc('messages.welcome', ['name' => 'Ana'])

// Explicit locale
loc('messages.welcome', ['name' => 'Ana'], 'ro')
```

Key format follows Laravel's convention: `group.key`. Keys without a dot are stored under the `*` group.

### Plural forms

Pass `count` in the replacements array — the singular or plural form is selected automatically.

```php
// DB value: "One product|:count products"
loc('shop.products', ['count' => 1])   // → "One product"
loc('shop.products', ['count' => 5])   // → "5 products"
```

Value format: `"singular|plural"` separated by a pipe character.

### The `Translate` facade

```php
use Translate;

Translate::trans('messages.welcome', ['name' => 'Ana']);
Translate::trans('shop.products', ['count' => 5]);
```

### Adding translations

```php
// Upsert a single key — cache is invalidated automatically
Translate::set('messages.welcome', 'Bun venit, :name!', 'ro');

// Bulk upsert — single INSERT ... ON DUPLICATE KEY UPDATE query
Translate::setMany([
    'messages.welcome' => 'Bun venit, :name!',
    'messages.goodbye' => 'La revedere!',
    'auth.login'       => 'Conectare',
], 'ro');
```

> **Note:** `setMany()` does not fire model events per row. The cache is flushed once at the end.

### Clearing the cache

```bash
# Clear all locales
php artisan locale:translations:clear

# Clear a specific locale
php artisan locale:translations:clear --locale=ro
```

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

| Column | Type | Notes |
|---|---|---|
| `id` | bigint | |
| `name` | string | e.g. `Romanian` |
| `code` | string(5) | ISO 639-1, e.g. `ro` |
| `enabled` | boolean | default `true` |
| `default` | boolean | default `false` |

### `Country`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint | |
| `name` | string | e.g. `Romania` |
| `code` | string(2) | ISO 3166-1 alpha-2, e.g. `RO` |
| `flag` | string | URL or path |
| `flag_emoji` | string | e.g. `🇷🇴` |
| `timezone` | string | e.g. `Europe/Bucharest` |
| `primary_language_id` | FK → languages | |

The `country_language` pivot table stores all official languages per country with an `is_official` boolean.

### `Translation`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint | |
| `group` | string | e.g. `messages`, `auth` — use `*` for ungrouped keys |
| `key` | string | e.g. `welcome` |
| `language_code` | string(10) | ISO 639-1, e.g. `ro` |
| `value` | text | Supports `:placeholder` and `singular\|plural` format |

Unique constraint on `(group, key, language_code)`.

---

## Octane compatibility

`LocaleService` and `TranslationService` are registered as singletons. Neither stores request-scoped state — the current locale is always read dynamically via `app()->getLocale()`.

`TranslationService` loads all translations for a locale in a **single query** on first access and keeps them in memory for the lifetime of the worker. Subsequent requests within the same worker pay zero database cost.

When a `Translation` model is saved or deleted, the `InvalidateTranslationCache` listener flushes both the in-memory array and the persistent cache entry for that locale.

---

## License

MIT
