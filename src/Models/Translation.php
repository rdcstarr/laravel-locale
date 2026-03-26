<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rdcstarr\Locale\Events\TranslationCreated;
use Rdcstarr\Locale\Events\TranslationDeleted;
use Rdcstarr\Locale\Events\TranslationUpdated;

#[WithoutTimestamps]
#[Fillable(['group', 'key', 'language_code', 'value'])]
class Translation extends Model
{
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
    #[Scope]
    protected function forLocale(Builder $query, string $locale): Builder
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
    #[Scope]
    protected function forGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }
}
