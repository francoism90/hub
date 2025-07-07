<?php

declare(strict_types=1);

namespace Domain\Videos\Commands;

use Domain\Users\Models\User;
use Domain\Videos\Jobs\ImportVideo;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\search;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\table;

class ImportVideos extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:import';

    /**
     * @var string
     */
    protected $description = 'Import videos to the database';

    public function handle(): void
    {
        $files = spin(
            message: 'Retrieving files...',
            callback: fn () => $this->getCollection()
        );

        if ($files->count() === 0) {
            info('No video files found in the import directory.');
            return;
        }

        table(
            headers: ['Filename', 'Filesize'],
            rows: collect($files->getIterator())->map(fn (SplFileInfo $file) => [
                Str::limit($file->getFilename()),
                Number::fileSize($file->getSize()),
            ])->all()
        );

        $user = search(
            label: 'Select user to assign videos to',
            validate: ['id' => 'required|exists:users,id'],
            placeholder: 'e.g. administrator@example.com',
            options: fn (string $value) => strlen($value) > 0
                ? User::whereLike('email', "%{$value}%")->pluck('email', 'id')->all()
                : []
        );

        $user = User::findOrFail($user);

        progress(
            label: 'Importing videos',
            steps: $files->getIterator(),
            callback: function (SplFileInfo $file, $progress) use ($user) {
                $progress
                    ->label("Importing {$file->getFilename()}")
                    ->hint("Filesize {$file->getSize()} bytes");

                return ImportVideo::dispatch($user, $file->getRealPath());
            }
        );
    }

    protected function getCollection(): Finder
    {
        $path = Storage::disk('import')->path('');

        return Finder::create()
            ->in($path)
            ->files()
            ->sortByName(useNaturalSort: true)
            ->filter(fn (SplFileInfo $file) => $file->isWritable() && str_starts_with(
                mime_content_type($file->getRealPath()), 'video/')
            );
    }
}
