<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Playlists\Actions\GetVideoStartTime;
use Domain\Playlists\Actions\MarkAsWatched;
use Illuminate\View\View;
use Livewire\Attributes\Session;
use Livewire\Component;

class Player extends Component
{
    use WithVideo;

    #[Session]
    public ?string $caption = 'en';

    public function render(): View
    {
        return view('app.videos.player.view')->with([
            'manifest' => $this->getManifest(),
            'startsAt' => $this->getStartTime(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.player.placeholder', $params);
    }

    public function updateHistory(?float $time = null): void
    {
        logger($time);
        if ($time === null || (! $user = auth()->user())) {
            return;
        }

        // app(MarkAsWatched::class)->execute($user, $this->getVideo(), $time);
    }

    protected function getManifest(): ?string
    {
        return $this->video->stream;
    }

    protected function getStartTime(): ?float
    {
        if (! $user = auth()->user()) {
            return null;
        }

        return app(GetVideoStartTime::class)->execute($user, $this->getVideo());
    }
}
