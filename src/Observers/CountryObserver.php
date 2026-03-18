<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Observers;

use Rdcstarr\Locale\Events\CountryCreated;
use Rdcstarr\Locale\Events\CountryDeleted;
use Rdcstarr\Locale\Events\CountryUpdated;
use Rdcstarr\Locale\Models\Country;

final class CountryObserver
{
    /**
     * Handle the Country "created" event.
     *
     * @param  Country $country
     * @return void
     */
    public function created(Country $country): void
    {
        CountryCreated::dispatch($country);
    }

    /**
     * Handle the Country "updated" event.
     *
     * @param  Country $country
     * @return void
     */
    public function updated(Country $country): void
    {
        CountryUpdated::dispatch($country);
    }

    /**
     * Handle the Country "deleted" event.
     *
     * @param  Country $country
     * @return void
     */
    public function deleted(Country $country): void
    {
        CountryDeleted::dispatch($country);
    }
}
