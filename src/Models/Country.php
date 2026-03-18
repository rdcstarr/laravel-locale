<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Rdcstarr\Locale\Observers\CountryObserver;

#[ObservedBy(CountryObserver::class)]
class Country extends Model
{
    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'code',
        'flag',
        'flag_emoji',
        'timezone',
        'primary_language_id',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'primary_language_id' => 'integer',
    ];

    /**
     * The primary language spoken in this country.
     *
     * @return BelongsTo<Language, $this>
     */
    public function primaryLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'primary_language_id');
    }

    /**
     * All languages officially used in this country.
     *
     * @return BelongsToMany<Language, $this>
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'country_language')
            ->withPivot('is_official');
    }

    /**
     * Only the officially recognised languages of this country.
     *
     * @return BelongsToMany<Language, $this>
     */
    public function officialLanguages(): BelongsToMany
    {
        return $this->languages()->wherePivot('is_official', true);
    }

    /**
     * Filter countries by ISO 3166-1 alpha-2 code (case-insensitive).
     *
     * @param  Builder<Country> $query
     * @param  string           $code
     * @return Builder<Country>
     */
    public function scopeByCode(Builder $query, string $code): Builder
    {
        return $query->where('code', Str::upper($code));
    }

    /**
     * Eager-load the primary language relationship.
     *
     * @param  Builder<Country> $query
     * @return Builder<Country>
     */
    public function scopeWithPrimaryLanguage(Builder $query): Builder
    {
        return $query->with('primaryLanguage');
    }

    /**
     * Filter countries that have a specific language via the pivot.
     *
     * @param  Builder<Country> $query
     * @param  string           $languageCode
     * @return Builder<Country>
     */
    public function scopeForLanguage(Builder $query, string $languageCode): Builder
    {
        return $query->whereHas('languages', function (Builder $q) use ($languageCode)
        {
            $q->where('code', Str::lower($languageCode));
        });
    }

    /**
     * Find a country by its ISO 3166-1 alpha-2 code.
     *
     * @param  string       $code
     * @return static|null
     */
    public static function findByCode(string $code): ?static
    {
        return static::byCode($code)->first();
    }

    /**
     * Return a code → id map for all countries.
     *
     * @return Collection<string, int>
     */
    public static function codeToId(): Collection
    {
        return static::pluck('id', 'code');
    }
}
