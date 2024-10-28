<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\MarkAsFavorited;
use Domain\Videos\Actions\MarkAsSaved;
use Domain\Videos\Actions\MarkAsViewed;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoViewController extends Page
{
    use WithVideo;

    public function mount(): void
    {
        app(MarkAsViewed::class)->execute($this->getAuthModel(), $this->video);
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

        return $this->video->isFavoritedBy($user);
    }

    #[Computed]
    public function isSaved(): bool
    {
        if (! $user = $this->getAuthModel()) {
            return false;
        }

        return $this->video->isSavedBy($user);
    }

    public function toggleFavorite(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        app(MarkAsFavorited::class)->execute($user, $this->video);
    }

    public function toggleSave(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        app(MarkAsSaved::class)->execute($user, $this->video);
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
