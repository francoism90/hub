<?php

namespace App\Web\Videos\Concerns;

use Domain\Videos\Models\Video;

trait WithVideo
{
    public Video $video;

    public function bootWithVideo(): void
    {
        $this->authorize('view', $this->video);
    }

    public function onVideoDeleted(): void
    {
        abort(404);
    }

    public function onVideoUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getVideo(): Video
    {
        return $this->video;
    }

    protected function getVideoId(): string
    {
        return $this->getVideo()->getRouteKey();
    }

    protected function getVideoListeners(): array
    {
        return [
            "echo-private:video.{$this->getVideoId()},.video.deleted" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},.video.updated" => 'onVideoUpdated',
            "echo-private:video.{$this->getVideoId()},.video.trashed" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},.video.restored" => 'onVideoUpdated',
        ];
    }
}
