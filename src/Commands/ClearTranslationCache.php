<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rdcstarr\Locale\Models\Translation;
use Rdcstarr\Locale\TranslationService;

#[Signature('locale:translations:clear {--locale= : Clear only for a specific locale (e.g. en, ro)}')]
#[Description('Clear the cached database translations (persistent cache + Octane in-memory layer)')]
final class ClearTranslationCache extends Command
{

    /**
     * Execute the command.
     *
     * @param  TranslationService $service
     * @return void
     */
    public function handle(TranslationService $service): void
    {
        $locale = (string) $this->option('locale');

        if (filled($locale))
        {
            $service->flushLocale($locale);
            $this->info("Translation cache cleared for locale [{$locale}].");

            return;
        }

        Translation::query()
            ->distinct()
            ->pluck('language_code')
            ->each($service->flushLocale(...));

        $this->info('Translation cache cleared for all locales.');
    }
}
