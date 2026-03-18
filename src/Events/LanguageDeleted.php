<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rdcstarr\Locale\Models\Language;

final class LanguageDeleted
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new LanguageDeleted event.
     *
     * @param Language $language
     */
    public function __construct(public readonly Language $language)
    {
    }
}
