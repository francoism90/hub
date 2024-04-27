<?php

namespace App\Livewire\Videos\Concerns;

use Domain\Videos\Models\Video;
use Livewire\Attributes\Locked;

trait WithVideo
{
    #[Locked]
    public Video $video;

    public function bootWithVideo(): void
    {
        $this->authorize('view', $this->video);
    }

    protected function getVideo(): Video
    {
        return $this->video;
    }

    protected function getVideoKey(): int
    {
        return $this->getVideo()->getKey();
    }

    protected function getVideoId(): string
    {
        return $this->getVideo()->getRouteKey();
    }

    protected function refreshVideo(): void
    {
        $this->getVideo()->refresh();

        $this->dispatch("video-updated.{$this->getVideoId()}");
    }

    public function onVideoDeleted(): void
    {
        $this->refreshVideo();
    }

    public function onVideoUpdated(): void
    {
        $this->refreshVideo();
    }

    protected function getVideoListeners(): array
    {
        return [
            "echo-private:video.{$this->getVideoId()},.video.deleted" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},.video.updated" => 'onVideoUpdated',
        ];
    }
}
