<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SplFileInfo;

class CreateNewVideoByImport
{
    public function handle(User $user, string $path): mixed
    {
        return DB::transaction(function () use ($user, $path) {
            $file = new SplFileInfo($path);

            $name = Str::of($file->getBasename(".{$file->getExtension()}"))->title();

            $video = $user->videos()->create([
                'name' => $name->value(),
            ]);

            $video
                ->addMedia($path)
                ->usingName($file->getFilename())
                ->usingFileName("vid.{$file->getExtension()}")
                ->toMediaCollection('clips');

            return $video;
        });
    }
}
