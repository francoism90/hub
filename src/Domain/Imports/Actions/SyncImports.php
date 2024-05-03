<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class SyncImports
{
    public function execute(): void
    {
        $finder = static::getImportables();

        $this->createModels($finder);

        $this->cleanupModels($finder);
    }

    protected function createModels(Finder $finder): void
    {
        collect($finder)
            ->each(fn (SplFileInfo $file) => app(CreateImport::class)->execute([
                'file_name' => $file->getFilename(),
                'name' => $file->getFilenameWithoutExtension(),
                'size' => $file->getSize(),
            ]));
    }

    protected function cleanupModels(Finder $finder): void
    {
        $fileNames = collect($finder)
            ->map(fn (SplFileInfo $file) => $file->getFilename())
            ->flatten();

        Import::query()
            ->pending()
            ->whereNotIn('file_name', $fileNames)
            ->delete();
    }

    protected static function getImportables(): Finder
    {
        return (new Finder)
            ->in(Storage::disk('import')->path(''))
            ->files()
            ->size('>= 1K')
            ->filter(fn (SplFileInfo $file) => $file->isWritable() && str_starts_with(
                mime_content_type($file->getRealPath()), 'video/')
            );
    }
}
