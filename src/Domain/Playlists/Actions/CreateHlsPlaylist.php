<?php

declare(strict_types=1);

namespace Domain\Playlists\Actions;

use Domain\Playlists\DataObjects\PlaylistProgressData;
use Domain\Playlists\Models\Playlist;
use Domain\Playlists\Jobs\PlaylistProgress;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\CopyVideoFormat;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Support\FFMpeg\Format\Video\X264;

class CreateHlsPlaylist
{
    public function handle(Model $model, string $disk, string $path): Playlist
    {
        return DB::transaction(function () use ($model, $disk, $path) {
            /** @var Playlist $playlist */
            $playlist = $model->playlists()->create([
                'file_name' => 'index.m3u8',
                'disk' => Playlist::getDestinationDisk(),
                'expires_at' => Playlist::getExpiresAfter(),
            ]);

            // Get valid codecs and formats
            $formats = app(GetPlaylistVideoFormat::class)->handle($disk, $path);

            // Get the playlists that can be created
            $playlists = Playlist::getHlsPlaylists();

            // Initialize ffmpeg exporter
            $ffmpeg = FFMpeg::fromDisk($disk)
                ->open($path)
                ->exportForHLS()
                ->withoutPlaylistEndLine()
                ->toDisk(Playlist::getDestinationDisk())
                ->setSegmentLength(Playlist::getSegmentLength())
                ->setKeyFrameInterval(Playlist::getFrameInterval())
                ->onProgress(fn (?float $percentage = null, ?float $remaining = null, ?float $rate = null) => PlaylistProgress::dispatch($playlist, PlaylistProgressData::from([
                    'percentage' => $percentage,
                    'remaining' => $remaining,
                    'rate' => $rate,
                ])));

            // Get the video format to use
            // Default to X264 if no specific format is provided
            $videoFormat = $formats->get('format', new X264);

            // Check if codecs can be copied or needs transcoding
            $copyVideoFormat = $formats->get('copy_video', false);
            $copyAudioFormat = $formats->get('copy_audio', false);

            // If transcoding is prevented and both codecs can be copied, use CopyVideoFormat
            if (Playlist::preventTranscoding() && $copyAudioFormat && $copyVideoFormat) {
                $videoFormat = app(CopyVideoFormat::class);
            }

            // Add formats to the ffmpeg exporter
            $playlists->each(function (Fluent $playlist) use ($ffmpeg, $videoFormat, $copyVideoFormat, $copyAudioFormat) {
                /** @var DefaultVideo $format */
                $format = $playlist->get('format', $videoFormat);

                if ($format instanceof CopyVideoFormat) {
                    $ffmpeg->addFormat($format);

                    return;
                }

                $ffmpeg->addFormat($format
                    ->setVideoCodec($copyVideoFormat ? 'copy' : $playlist->get('video_codec', $videoFormat->getVideoCodec()))
                    ->setAudioCodec($copyAudioFormat ? 'copy' : $playlist->get('audio_codec', $videoFormat->getAudioCodec()))
                    ->setKiloBitrate($playlist->get('kilo_bitrate', $videoFormat->getKiloBitrate()))
                );
            });

            // Run the transcoding process
            $ffmpeg->save("{$playlist->getPath()}/{$playlist->file_name}");

            // Mark the playlist as transcoded
            $playlist->touch('transcoded_at');

            return $playlist;
        });
    }
}
