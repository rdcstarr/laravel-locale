<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rdcstarr\Locale\Models\Translation;

final class TranslationUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new TranslationUpdated event.
     *
     * @param Translation $translation
     */
    public function __construct(public readonly Translation $translation)
    {
    }
}
