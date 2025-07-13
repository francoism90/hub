<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Playlists\Actions\GetPlaylistVideoFormat;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\CopyVideoFormat;
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












            // Run the transcoding process
            $ffmpeg->save("{$playlist->getPath()}/{$playlist->file_name}");

            // Mark the playlist as finished
            $playlist->updateOrFail(['finished_at' => now()]);

            return $next($video);
        });
    }
}
