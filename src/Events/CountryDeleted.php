<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rdcstarr\Locale\Models\Country;

final class CountryDeleted
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new CountryDeleted event.
     *
     * @param Country $country
     */
    public function __construct(public readonly Country $country)
    {
    }
}
