<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateVideoPlaylist
{
    public function handle(Video $video, Closure $next): mixed
    {
        return DB::transaction(function () use ($video, $next) {
            $media = $video->getClipCollection()->first();

            if (! $media) {
                return $next($video);
            }

            // Create a new playlist for the video
            $playlist = $video->playlists()->create([
                'file_name' => 'index.m3u8',
                'disk' => Playlist::getDestinationDisk(),
                'expires_at' => Playlist::getExpiresAfter(),
            ]);

            // Initialize ffmpeg exporter
            $ffmpeg = FFMpeg::fromDisk($media->disk)
                ->open($media->getPathRelativeToRoot())
                ->exportForHLS()
                ->withoutPlaylistEndLine()
                ->toDisk($playlist->disk)
                ->setSegmentLength(Playlist::getSegmentLength())
                ->setKeyFrameInterval(Playlist::getFrameInterval());

            // Validate codecs and formats
            $formats = Playlist::getVideoFormats();

            $videoCodec = $ffmpeg->getVideoStream()->get('codec_name');
            $audioCodec = $ffmpeg->getAudioStream()->get('codec_name');

            $format = $formats->first(
                fn (DefaultVideo $videoFormat) => method_exists($videoFormat, 'getAvailableVideoCodecs')
                    && in_array($audioCodec, $videoFormat->getAvailableAudioCodecs())
                    && in_array($videoCodec, $videoFormat->getAvailableVideoCodecs()),
                fn () => $formats->first()
            );

            // Check if the format can be copied or needs transcoding
            $copyAudioFormat = (Playlist::copyAudioCodec() && in_array($audioCodec, $format->getAvailableAudioCodecs()));
            $copyVideoFormat = (Playlist::copyVideoCodec() && in_array($videoCodec, $format->getAvailableVideoCodecs()));

            // Add the format to the ffmpeg exporter
            $ffmpeg->addFormat(
                $format
                    ->setAudioCodec($copyAudioFormat ? 'copy' : $format->getAudioCodec())
                    ->setVideoCodec($copyVideoFormat ? 'copy' : $format->getVideoCodec())
                    ->setKiloBitrate(Playlist::getKiloBitrate()) // on copy, this is ignored
                    ->setPasses(Playlist::getPasses()) // on copy, this is ignored
                    ->setAdditionalParameters(Playlist::getAdditionalParameters())
            );

            // Run the transcoding process
            $ffmpeg->save("{$playlist->getPath()}/{$playlist->file_name}");

            // Mark the playlist as finished
            $playlist->updateOrFail(['finished_at' => now()]);

            return $next($video);
        });
    }
}
