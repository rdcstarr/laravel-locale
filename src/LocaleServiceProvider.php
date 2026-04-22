<?php

declare(strict_types=1);

namespace Rdcstarr\Locale;

use Illuminate\Support\Facades\Event;
use Rdcstarr\Locale\Commands\ClearTranslationCache;
use Rdcstarr\Locale\Database\Seeders\CountriesSeeder;
use Rdcstarr\Locale\Database\Seeders\CountryLanguageSeeder;
use Rdcstarr\Locale\Database\Seeders\LanguagesSeeder;
use Rdcstarr\Locale\Events\TranslationCreated;
use Rdcstarr\Locale\Events\TranslationDeleted;
use Rdcstarr\Locale\Events\TranslationUpdated;
use Rdcstarr\Locale\Listeners\InvalidateTranslationCache;
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
            ->hasMigration('create_languages_table')
            ->hasMigration('create_countries_table')
            ->hasMigration('add_calling_code_to_countries_table')
            ->hasMigration('create_country_language_table')
            ->hasMigration('create_translations_table')
            ->runsMigrations()
            ->hasCommand(ClearTranslationCache::class)
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
        $this->app->singleton(TranslationService::class);
    }

    /**
     * Boot package services.
     *
     * @return void
     */
    public function packageBooted(): void
    {
        Event::listen(
            [TranslationCreated::class, TranslationUpdated::class, TranslationDeleted::class],
            InvalidateTranslationCache::class,
        );
    }
}
