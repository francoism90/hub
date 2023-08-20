<?php

namespace Domain\Media\Commands;

use Domain\Media\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class MissingModels extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'media:missing';

    /**
     * @var string
     */
    protected $description = 'Scan for files without any media model';

    public function handle(): void
    {
        $files = (new Finder)
            ->in(Storage::disk('media')->path(''))
            ->files();

        if (! $files) {
            $this->info('No files found.');

            return;
        }

        $this->withProgressBar($files, function (SplFileInfo $file) {
            $id = $file->getRelativePath();
            $name = $file->getBasename();

            if (! $this->exists($id)) {
                $this->error(sprintf('Missing model: %d - %s',
                    $id, $name
                ));
            }
        });
    }

    protected function exists(mixed $id): bool
    {
        return Media::query()
            ->select('id')
            ->where('id', $id)
            ->exists();
    }
}
