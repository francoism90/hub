<?php

namespace App\Web\Videos\Concerns;

use Domain\Users\Models\User;
use Domain\Videos\Actions\MarkVideoViewed;
use Domain\Videos\Actions\MarkVideoWatchlisted;
use Domain\Videos\Models\Video;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

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

        $this->emit('$refresh');
    }

    protected function videoViewed(User $user = null, array $options = null): void
    {
        /** @var User */
        $user ??= auth()->user();

        if (filled($user)) {
            app(MarkVideoViewed::class)->execute($user, $this->video, $options);
        }
    }

    protected function videoWatchlisted(User $user = null, array $options = null): void
    {
        /** @var User */
        $user ??= auth()->user();

        if (filled($user)) {
            app(MarkVideoWatchlisted::class)->execute($user, $this->video, $options);
        }
    }

    protected function onVideoDeleted(): void
    {
        $this->refreshVideo();
    }

    protected function onVideoSaved(): void
    {
        $this->refreshVideo();
    }

    protected function getVideoListeners(): array
    {
        return [
            "echo-private:video.{$this->getVideoId()},deleted" => 'onVideoDeleted',
            "echo-private:video.{$this->getVideoId()},saved" => 'onVideoSaved',
        ];
    }
}
