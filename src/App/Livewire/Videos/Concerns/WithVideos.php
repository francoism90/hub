<?php

namespace App\Livewire\Videos\Concerns;

use Domain\Videos\Models\Video;

trait WithVideos
{
    public ?Video $video = null;

    public function bootWithVideos(): void
    {
        if ($this->video instanceof Video) {
            $this->authorize('view', $this->video);
        }
    }

    public function onVideoDeleted(): void
    {
        //
    }

    public function onVideoUpdated(): void
    {
        //
    }

    protected function getVideoId(): ?string
    {
        return $this->video?->getRouteKey();
    }

    protected function getVideoListeners(): array
    {
        return [
            "echo-private:video.{$this->getVideoId()},.video.deleted" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},.video.updated" => 'onVideoUpdated',
        ];
    }
}
