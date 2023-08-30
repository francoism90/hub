<?php

namespace App\Web\Videos\Controllers;

use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Concerns\WithVideo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\View\View;
use Livewire\Component;

class VideoViewController extends Component
{
    use WithAuthentication;
    use WithVideo;
    use WithWatchlist;

    public function mount(): void
    {
        SEOMeta::setTitle($this->video?->name);

        $this->videoViewed();
    }

    public function render(): View
    {
        return view('videos::view');
    }

    public function toggleWatchlist(): void
    {
        $this->isWatchlisted($this->video)
            ? $this->getWatchlist()->detachVideo($this->video)
            : $this->getWatchlist()->attachVideo($this->video);

        $this->refreshVideo();
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
