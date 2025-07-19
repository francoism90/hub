<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Playlists\Actions\CreateHlsPlaylist;
use Domain\Playlists\Actions\CreateNewPlaylist;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Events\VideoHasBeenTranscoded;
use Domain\Videos\Exceptions\EmptyClipCollection;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoPlaylist
{
    public function handle(Video $video): mixed
    {
        return DB::transaction(function () use ($video) {
            throw_unless($video->hasMedia('clips'), EmptyClipCollection::make());

            // Get the first media item from the video
            $media = $video->getClipCollection()->first();

            // Create a new playlist for the video
            $playlist = app(CreateNewPlaylist::class)->handle($video);

            // Create a new playlist for the video
            app(CreateHlsPlaylist::class)->handle($playlist, $media->disk, $media->getPathRelativeToRoot());

            // Dispatch the event that the video has been transcoded
            VideoHasBeenTranscoded::dispatch($video);
        });
    }
}
