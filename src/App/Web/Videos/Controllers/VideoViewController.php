<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Playlists\Actions\MarkAsFavorited;
use Domain\Playlists\Actions\MarkAsWatchlisted;
use Domain\Playlists\Jobs\MarkWatched;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

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

    #[Computed]
    public function isFavorited(): bool
    {
        if (! $user = static::getAuthUser()) {
            return false;
        }

        return $this->video->isFavoritedBy($user);
    }

    #[Computed]
    public function isWatchlisted(): bool
    {
        if (! $user = static::getAuthUser()) {
            return false;
        }

        return $this->video->isWatchlistedBy($user);
    }

    public function toggleFavorite(): void
    {
        if (! $user = static::getAuthUser()) {
            return;
        }

        app(MarkAsFavorited::class)->execute($user, $this->video);
    }

    public function toggleWatchlist(): void
    {
        if (! $user = static::getAuthUser()) {
            return;
        }

        app(MarkAsWatchlisted::class)->execute($user, $this->video);
    }

    protected function getTitle(): ?string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): ?string
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
