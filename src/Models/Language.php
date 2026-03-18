<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Rdcstarr\Locale\Observers\LanguageObserver;

#[ObservedBy(LanguageObserver::class)]
class Language extends Model
{
    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'code',
        'enabled',
        'default',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'enabled' => 'boolean',
        'default'  => 'boolean',
    ];

    /**
     * The countries that officially use this language.
     *
     * @return BelongsToMany<Country, $this>
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'country_language')
            ->withPivot('is_official');
    }

    /**
     * Limit results to enabled languages.
     *
     * @param  Builder<Language> $query
     * @return Builder<Language>
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', true);
    }

    /**
     * Limit results to the default language.
     *
     * @param  Builder<Language> $query
     * @return Builder<Language>
     */
    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('default', true);
    }

    /**
     * Return a code → id map for all enabled languages.
     *
     * @return Collection<string, int>
     */
    public static function enabledCodeToId(): Collection
    {
        return static::enabled()->pluck('id', 'code');
    }

    /**
     * Return the default language, or null if none is set.
     *
     * @return static|null
     */
    public static function defaultLanguage(): ?static
    {
        return static::default()->first();
    }
}
