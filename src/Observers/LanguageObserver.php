<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Observers;

use Rdcstarr\Locale\Events\LanguageCreated;
use Rdcstarr\Locale\Events\LanguageDeleted;
use Rdcstarr\Locale\Events\LanguageUpdated;
use Rdcstarr\Locale\Models\Language;

final class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     *
     * @param  Language $language
     * @return void
     */
    public function created(Language $language): void
    {
        LanguageCreated::dispatch($language);
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  Language $language
     * @return void
     */
    public function updated(Language $language): void
    {
        LanguageUpdated::dispatch($language);
    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  Language $language
     * @return void
     */
    public function deleted(Language $language): void
    {
        LanguageDeleted::dispatch($language);
    }
}
