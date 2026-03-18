<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rdcstarr\Locale\Models\Country;

final class CountryUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new CountryUpdated event.
     *
     * @param Country $country
     */
    public function __construct(public readonly Country $country)
    {
    }
}
