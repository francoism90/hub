<?php

namespace Domain\Videos\Commands;

use Domain\Videos\Actions\CreateVideoByFile;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ImportVideos extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:import {user=1} {--A|adult}';

    /**
     * @var string
     */
    protected $description = 'Import video files to the library';

    public function handle(): void
    {
        $files = (new Finder)
            ->in(Storage::disk('import')->path(''))
            ->files()
            ->size('>= 10K')
            ->filter(fn (SplFileInfo $file) => str_starts_with(mime_content_type($file->getRealPath()), 'video/'));

        if (! $files) {
            $this->info('No files found to import');

            return;
        }

        $user = $this->argument('user');

        $adult = $this->option('adult');

        $this->withProgressBar($files, fn (SplFileInfo $file) => app(CreateVideoByFile::class)->execute(
            $file, $user, $adult
        ));
    }
}
