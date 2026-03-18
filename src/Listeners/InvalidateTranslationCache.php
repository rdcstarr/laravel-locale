<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Listeners;

use Illuminate\Events\Attributes\AsEventListener;
use Rdcstarr\Locale\Events\TranslationCreated;
use Rdcstarr\Locale\Events\TranslationDeleted;
use Rdcstarr\Locale\Events\TranslationUpdated;
use Rdcstarr\Locale\TranslationService;

#[AsEventListener(TranslationCreated::class)]
#[AsEventListener(TranslationUpdated::class)]
#[AsEventListener(TranslationDeleted::class)]
final class InvalidateTranslationCache
{
    /**
     * Flush the translation cache for the affected locale.
     *
     * @param  TranslationCreated|TranslationUpdated|TranslationDeleted $event
     * @return void
     */
    public function handle(TranslationCreated|TranslationUpdated|TranslationDeleted $event): void
    {
        app(TranslationService::class)->flushLocale($event->translation->language_code);
    }
}
