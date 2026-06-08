<?php

declare(strict_types=1);

use Rdcstarr\Locale\LocaleService;

if (!function_exists('country_calling_code'))
{
	/**
	 * Return the ITU-T E.164 calling code for a country (e.g. "+40"), or null if unknown.
	 *
	 * @param  string      $code ISO 3166-1 alpha-2, case-insensitive
	 * @return string|null
	 */
	function country_calling_code(string $code): ?string
	{
		return app(LocaleService::class)->callingCodeByCode($code);
	}
}
