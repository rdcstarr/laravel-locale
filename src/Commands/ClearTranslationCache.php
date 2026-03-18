<?php

declare(strict_types=1);

namespace Rdcstarr\Locale\Commands;

use Illuminate\Console\Command;
use Rdcstarr\Locale\Models\Translation;
use Rdcstarr\Locale\TranslationService;

final class ClearTranslationCache extends Command
{
    /** @var string */
    protected $signature = 'locale:translations:clear
                            {--locale= : Clear only for a specific locale (e.g. en, ro)}';

    /** @var string */
    protected $description = 'Clear the cached database translations (persistent cache + Octane in-memory layer)';

    /**
     * Execute the command.
     *
     * @param  TranslationService $service
     * @return void
     */
    public function handle(TranslationService $service): void
    {
        $locale = $this->option('locale');

        if (filled($locale))
        {
            $service->flushLocale($locale);
            $this->info("Translation cache cleared for locale [{$locale}].");

            return;
        }

        Translation::query()
            ->distinct()
            ->pluck('language_code')
            ->each(fn (string $code) => $service->flushLocale($code));

        $this->info('Translation cache cleared for all locales.');
    }
}
