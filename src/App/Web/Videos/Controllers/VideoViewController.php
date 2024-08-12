<?php

namespace App\Web\Videos\Controllers;

use App\Web\Lists\Concerns\WithPlaylist;
use App\Web\Videos\Concerns\WithVideo;
use Domain\Playlists\Actions\MarkAsSeen;
use Domain\Playlists\Jobs\MarkWatched;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoViewController extends Page
{
    use WithVideo;

    public function mount(): void
    {
        if (! $user = static::getAuthUser()) {
            return;
        }

        MarkWatched::dispatch($user, $this->video);
    }

    public function render(): View
    {
        return view('app.videos.view');
    }

    protected function getTitle(): string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->video->summary;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
