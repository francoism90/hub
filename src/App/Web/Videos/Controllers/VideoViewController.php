<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\MarkVideoAsFavorited;
use Domain\Videos\Actions\MarkVideoAsSaved;
use Domain\Videos\Actions\MarkVideoAsViewed;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoViewController extends Page
{
    use WithVideo;

    public function mount(): void
    {
        app(MarkVideoAsViewed::class)->execute($this->getAuthModel(), $this->getVideo());
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

        return $this->getVideo()->isFavoritedBy($user);
    }

    #[Computed]
    public function isSaved(): bool
    {
        if (! $user = $this->getAuthModel()) {
            return false;
        }

        return $this->getVideo()->isSavedBy($user);
    }

    public function toggleFavorite(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        app(MarkVideoAsFavorited::class)->execute($user, $this->getVideo());
    }

    public function toggleSave(): void
    {
        if (! $user = $this->getAuthModel()) {
            return;
        }

        app(MarkVideoAsSaved::class)->execute($user, $this->getVideo());
    }

    protected function getTitle(): ?string
    {
        return (string) $this->getVideo()->title;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->getVideo()->summary;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
