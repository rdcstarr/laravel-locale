<?php

declare(strict_types=1);

namespace Rdcstarr\Locale;

use Rdcstarr\Locale\Database\Seeders\CountriesSeeder;
use Rdcstarr\Locale\Database\Seeders\CountryLanguageSeeder;
use Rdcstarr\Locale\Database\Seeders\LanguagesSeeder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class LocaleServiceProvider extends PackageServiceProvider
{
	/**
	 * Configure the laravel-locale package.
	 *
	 * @param  Package $package
	 * @return void
	 */
	public function configurePackage(Package $package): void
	{
		$package
			->name('laravel-locale')
			->discoversMigrations()
			->runsMigrations()
			->hasInstallCommand(function (InstallCommand $command)
			{
				$command
					->startWith(function (InstallCommand $command)
					{
						$command->info('Installing laravel-locale…');
					})
					->publishMigrations()
					->askToRunMigrations()
					->endWith(function (InstallCommand $command)
					{
						$command->call('db:seed', ['--class' => LanguagesSeeder::class]);
						$command->call('db:seed', ['--class' => CountriesSeeder::class]);
						$command->call('db:seed', ['--class' => CountryLanguageSeeder::class]);
						$command->info('laravel-locale installed successfully.');
					});
			});
	}

	/**
	 * Register package bindings into the service container.
	 *
	 * @return void
	 */
	public function packageRegistered(): void
	{
		$this->app->singleton(LocaleService::class);
	}
}
