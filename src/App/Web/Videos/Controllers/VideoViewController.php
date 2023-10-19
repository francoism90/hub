<?php

namespace App\Web\Videos\Controllers;

use App\Web\Playlists\Concerns\WithFavorites;
use App\Web\Playlists\Concerns\WithHistory;
use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Shared\Concerns\WithRateLimiting;
use App\Web\Videos\Concerns\WithVideo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Actions\GetSimilarVideos;
use Illuminate\Support\LazyCollection;
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
        SEOMeta::setTitle((string) $this->video?->name);
    }

    public function render(): View
    {
        return view('videos::view');
    }

    #[On('time-update')]
    public function updateHistory(float $time = 0): void
    {
        $this->authorize('update', static::history());

        static::history()->attachVideo($this->video, [
            'timestamp' => round($time, 2),
        ]);
    }

    public function toggleFavorite(): void
    {
        $this->authorize('update', $model = static::favorites());

        $this->isFavorited($this->video)
            ? $model->detachVideo($this->video)
            : $model->attachVideo($this->video);
    }

    public function toggleWatchlist(): void
    {
        $this->authorize('update', $model = static::watchlist());

        $this->isWatchlisted($this->video)
            ? $model->detachVideo($this->video)
            : $model->attachVideo($this->video);
    }

    #[Computed]
    public function favorited(): string
    {
        return $this->isFavorited($this->video)
            ? 'heroicon-s-heart'
            : 'heroicon-o-heart';
    }

    #[Computed]
    public function watchlisted(): string
    {
        return $this->isWatchlisted($this->video)
            ? 'heroicon-s-clock'
            : 'heroicon-o-clock';
    }

    #[Computed]
    public function starts(): float
    {
        $model = static::history()
            ->videos()
            ->find($this->video);

        return data_get($model?->pivot->options, 'timestamp', 0);
    }

    #[Computed]
    public function similar(): LazyCollection
    {
        return app(GetSimilarVideos::class)->execute($this->video);
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
