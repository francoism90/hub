<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe\DataMapping\Stream;
use Spatie\MediaLibrary\Support\TemporaryDirectory;
use Support\FFMpeg\Format\Subtitle\WebVTT;

class ExtractVideoSubtitles
{
    public function execute(Video $model): void
    {
        if (! $model->hasMedia('clips') || $model->hasMedia('captions')) {
            return;
        }

        $temporaryDirectory = TemporaryDirectory::create()
            ->deleteWhenDestroyed();

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
            'temporary_directory' => $temporaryDirectory->path(),
            'ffmpeg.threads' => 0,
            'timeout' => 60 * 30,
        ]);

        $file = $model->clips()->first()->getPath();

        $video = $ffmpeg->openAdvanced([$file]);

        // Extract subtitles
        $collect = collect($ffmpeg->getFFProbe()->streams($file))
            ->filter(fn (Stream $stream) => $stream->get('codec_type') === 'subtitle')
            ->mapWithKeys(fn (Stream $stream) => [
                $stream->get('index') => $temporaryDirectory->path(
                    "{$stream->get('index')}_{$stream->get('tags.language', 'eng')}.vtt"
                ),
            ])
            ->each(fn (string $path, int $key) => $video->map(
                outs: ["0:{$key}"],
                format: new WebVTT(),
                outputFilename: $path,
                forceDisableAudio: true,
                forceDisableVideo: true,
            ));

        if ($collect->isNotEmpty()) {
            // Output subtitles
            $video->save();

            // Import subtitles
            $collect->each(fn (string $path, int $key) => $model
                ->addMedia($path)
                ->withAttributes(['mime_type' => 'text/vtt'])
                ->toMediaCollection('captions')
            );
        }

        $temporaryDirectory->delete();
    }
}
