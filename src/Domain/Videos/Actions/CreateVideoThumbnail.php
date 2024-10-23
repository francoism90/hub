<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Filters\Video\ResizeFilter;
use Spatie\MediaLibrary\Support\TemporaryDirectory;
use Spatie\TemporaryDirectory\TemporaryDirectory as BaseTemporaryDirectory;

class CreateVideoThumbnail
{
    public function execute(Video $model): void
    {
        if (! $model->hasMedia('clips')) {
            return;
        }

        $temporaryDirectory = $this->createTemporaryDirectory();

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
            'temporary_directory' => $temporaryDirectory->path(),
            'ffmpeg.threads' => 0,
            'timeout' => 60 * 30,
        ]);

        $file = $model->clips->first()->getPath();

        $video = $ffmpeg->open($file);

        $path = $temporaryDirectory->path('thumb.jpg');

        $duration = (float) $ffmpeg->getFFProbe()->format($file)->get('duration');

        $quantity = round((float) $model->snapshot ?: ($duration / 2), 1);

        $video
            ->filters()
            ->resize(new Dimension(960, 540), ResizeFilter::RESIZEMODE_INSET)
            ->synchronize();

        $video
            ->frame(TimeCode::fromSeconds($quantity))
            ->save($path);

        $model
            ->addMedia($path)
            ->toMediaCollection('thumbnail');
    }

    protected function createTemporaryDirectory(): BaseTemporaryDirectory
    {
        return TemporaryDirectory::create()
            ->deleteWhenDestroyed();
    }
}
