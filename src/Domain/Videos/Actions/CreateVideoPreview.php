<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Support\TemporaryDirectory;

class CreateVideoPreview
{
    public function execute(Video $model): void
    {
        $temporaryDirectory = (new TemporaryDirectory)->create();

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
            'temporary_directory' => $temporaryDirectory->path(),
            'ffmpeg.threads' => 0,
            'timeout' => 60 * 30,
        ]);

        $file = $model->clips()->first()->getPath();

        $video = $ffmpeg->open($file);

        $path = $temporaryDirectory->path('preview.mp4');

        $duration = $ffmpeg->getFFProbe()->format($file)->get('duration');

        $clips = $this->getSegments($duration)
            ->map(function (float $item, int $key) use ($temporaryDirectory, $video) {
                $path = $temporaryDirectory->path("clip_{$key}.mp4");

                $format = (new X264())
                    ->setKiloBitrate(1500)
                    ->setAudioCodec('copy')
                    ->setAdditionalParameters(['-an']);

                $clip = $video->clip(
                    TimeCode::fromSeconds($item),
                    TimeCode::fromSeconds(1)
                );

                $clip
                    ->filters()
                    ->resize(new Dimension(320, 240), ResizeFilter::RESIZEMODE_INSET)
                    ->synchronize();

                $clip->save($format, $path);

                return compact('key', 'path');
            });

        $video
            ->concat($clips->sortBy('key')->pluck('path')->all())
            ->saveFromSameCodecs($path, true);

        $model
            ->addMedia($path)
            ->toMediaCollection('previews');

        $temporaryDirectory->delete();
    }

    protected function getSegments(float $duration, int $count = 14): Collection
    {
        $collect = collect(range(0, $duration, $duration / $count))
            ->map(fn (float $segment) => floor($segment))
            ->unique()
            ->take($count);

        $collect->shift();
        $collect->pop();

        return $collect;
    }
}
