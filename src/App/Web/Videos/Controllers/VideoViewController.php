<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Activities\Actions\MarkAsViewed;
use Domain\Groups\Actions\MarkAsFavorited;
use Domain\Groups\Actions\MarkAsWatchlisted;
use Domain\Groups\Jobs\MarkWatched;
use Domain\Videos\Actions\SyncWatchHistory;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoViewController extends Page
{
    use WithVideo;

    public function mount(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        app(MarkAsViewed::class)->execute($user, $this->video);
    }

    public function render(): View
    {
        return view('app.videos.view');
    }

    #[Computed]
    public function isFavorited(): bool
    {
        if (! $user = $this->getAuthModel()) {
            return false;
        }

        return false;

        // return $this->video->isFavoritedBy($user);
    }

    #[Computed]
    public function isWatchlisted(): bool
    {
        if (! $user = $this->getAuthModel()) {
            return false;
        }

        return false;

        // return $this->video->isWatchlistedBy($user);
    }

    public function toggleFavorite(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        // app(MarkAsFavorited::class)->execute($user, $this->video);
    }

    public function toggleWatchlist(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        // app(MarkAsWatchlisted::class)->execute($user, $this->video);
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
