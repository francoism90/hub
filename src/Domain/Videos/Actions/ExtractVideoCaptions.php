<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Videos\Models\Video;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe\DataMapping\Stream;
use Spatie\MediaLibrary\Support\TemporaryDirectory;
use Spatie\TemporaryDirectory\TemporaryDirectory as BaseTemporaryDirectory;
use Support\FFMpeg\Format\Subtitle\WebVTT;

class ExtractVideoCaptions
{
    public function __invoke(Video $model, Closure $next): mixed
    {
        if ($model->hasCaptions() || ! $model->hasMedia('clips')) {
            return $next($model);
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

        $video = $ffmpeg->openAdvanced([$file]);

        // Build a collection of caption streams
        $collect = collect($ffmpeg->getFFProbe()->streams($file))
            ->filter(fn (Stream $stream) => $stream->get('codec_type') === 'subtitle')
            ->mapWithKeys(fn (Stream $stream) => [
                $stream->get('index') => $temporaryDirectory->path(
                    "{$stream->get('index')}_{$stream->get('tags.language', 'eng')}.vtt"
                ),
            ])
            ->each(fn (string $path, int $key) => $video->map(
                outs: ["0:{$key}"],
                format: new WebVTT,
                outputFilename: $path,
                forceDisableAudio: true,
                forceDisableVideo: true,
            ));

        // Check if any captions were extracted
        if ($collect->isNotEmpty()) {
            // Extract video captions
            $video->save();

            // Import captions to the media library
            $collect->each(fn (string $path, int $key) => $model
                ->addMedia($path)
                ->withAttributes(['mime_type' => 'text/vtt'])
                ->toMediaCollection('captions')
            );
        }

        return $next($model);
    }

    protected function createTemporaryDirectory(): BaseTemporaryDirectory
    {
        return TemporaryDirectory::create()
            ->deleteWhenDestroyed();
    }
}
