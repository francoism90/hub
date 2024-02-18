<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Spatie\MediaLibrary\Support\TemporaryDirectory;

class CreateVideoThumbnail
{
    public function execute(Video $model): void
    {
        if (! $model->hasMedia('clips')) {
            return;
        }

        $temporaryDirectory = TemporaryDirectory::create()
            ->deleteWhenDestroyed();

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
            'temporary_directory' => $temporaryDirectory->path(),
            'ffmpeg.threads' => 0,
            'timeout' => 60 * 15,
        ]);

        $file = $model->clips()->first()->getPath();

        $video = $ffmpeg->open($file);

        $path = $temporaryDirectory->path('thumb.jpg');

        $duration = $ffmpeg->getFFProbe()->format($file)->get('duration');

        $quantity = round($model->snapshot ?: ($duration / 2), 1);

        $video
            ->filters()
            ->synchronize();

        $video
            ->frame(TimeCode::fromSeconds($quantity))
            ->save($path);

        $model
            ->addMedia($path)
            ->toMediaCollection('thumbnail');

        $temporaryDirectory->delete();
    }
}
