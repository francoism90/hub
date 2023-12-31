<?php

namespace App\Web\Videos\Concerns;

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

    protected function getVideoId(): string
    {
        return $this->video->getRouteKey();
    }

    protected function refreshVideo(): void
    {
        $this->video->refresh();

        $this->dispatch('$refresh');
    }

    public function onVideoDeleted(): void
    {
        $this->refreshVideo();
    }

    public function onVideoSaved(): void
    {
        $this->refreshVideo();
    }

    protected function getVideoListeners(): array
    {
        return [
            "echo-private:video.{$this->getVideoId()},.deleted" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},.saved" => 'onVideoSaved',
        ];
    }
}
