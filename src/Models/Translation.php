<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rdcstarr\Locale\Events\TranslationCreated;
use Rdcstarr\Locale\Events\TranslationDeleted;
use Rdcstarr\Locale\Events\TranslationUpdated;

class Translation extends Model
{
    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'group',
        'key',
        'language_code',
        'value',
    ];

    /** @var array<string, class-string> */
    protected $dispatchesEvents = [
        'created' => TranslationCreated::class,
        'updated' => TranslationUpdated::class,
        'deleted' => TranslationDeleted::class,
    ];

    /**
     * Limit results to a given locale.
     *
     * @param  Builder<Translation> $query
     * @param  string               $locale
     * @return Builder<Translation>
     */
    public function scopeForLocale(Builder $query, string $locale): Builder
    {
        return $query->where('language_code', $locale);
    }

    /**
     * Limit results to a given group.
     *
     * @param  Builder<Translation> $query
     * @param  string               $group
     * @return Builder<Translation>
     */
    public function scopeForGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }
}
