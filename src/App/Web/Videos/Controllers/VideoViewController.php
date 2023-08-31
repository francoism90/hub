<?php

namespace App\Web\Videos\Controllers;

use App\Web\Playlists\Concerns\WithFavorites;
use App\Web\Playlists\Concerns\WithHistory;
use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Concerns\WithVideo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class VideoViewController extends Component
{
    use WithAuthentication;
    use WithFavorites;
    use WithHistory;
    use WithVideo;
    use WithWatchlist;

    public function mount(): void
    {
        SEOMeta::setTitle($this->video?->name);
    }

    public function render(): View
    {
        return view('videos::view');
    }

    #[On('time-update')]
    public function updateHistory(float $time = 0): void
    {
        $model = $this->getHistory()->videos()->find($this->video);

        if ($model && now()->diffInMilliseconds($model->pivot->updated_at) < 950) {
            return;
        }

        $this->getHistory()->attachVideo($this->video, [
            'timestamp' => round($time),
        ]);
    }

    public function toggleFavorite(): void
    {
        $this->isFavorited($this->video)
            ? $this->getFavorites()->detachVideo($this->video)
            : $this->getFavorites()->attachVideo($this->video);
    }

    public function toggleWatchlist(): void
    {
        $this->isWatchlisted($this->video)
            ? $this->getWatchlist()->detachVideo($this->video)
            : $this->getWatchlist()->attachVideo($this->video);
    }

    #[Computed]
    public function favorite(): string
    {
        return $this->isFavorited($this->video)
            ? 'heroicon-s-heart'
            : 'heroicon-o-heart';
    }

    #[Computed]
    public function watchlist(): string
    {
        return $this->isWatchlisted($this->video)
            ? 'heroicon-s-clock'
            : 'heroicon-o-clock';
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
