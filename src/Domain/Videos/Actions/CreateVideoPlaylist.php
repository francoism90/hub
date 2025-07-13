<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Playlists\Actions\CreateNewHlsPlaylist;
use Domain\Videos\Events\VideoHasBeenTranscoded;
use Domain\Videos\Exceptions\EmptyClipCollection;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoPlaylist
{
    public function handle(Video $video): mixed
    {
        return DB::transaction(function () use ($video) {
            throw_if($video->hasMedia('clips'), EmptyClipCollection::make());

            $media = $video->getClipCollection()->first();

            // Create a new playlist for the video
            app(CreateNewHlsPlaylist::class)->handle($video, $media->disk, $media->getPathRelativeToRoot());

            // Dispatch the event that the video has been transcoded
            VideoHasBeenTranscoded::dispatch($video);
        });
    }
}
