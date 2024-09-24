<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Playlists\Actions\SyncVideoTimeCode;
use Illuminate\View\View;
use Livewire\Attributes\Session;
use Livewire\Component;

class Player extends Component
{
    use WithVideo;

    #[Session(key: 'caption')]
    public int|string|null $caption = null;

    public function render(): View
    {
        return view('app.videos.player.view')->with([
            'manifest' => $this->getManifest(),
            'timecode' => $this->getTimeCode(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.player.placeholder', $params);
    }

    public function updateHistory(?float $time = null): void
    {
        if ($time === null || (! $user = auth()->user())) {
            return;
        }

        app(SyncVideoTimeCode::class)->execute($user, $this->getVideo(), $time);
    }

    protected function getManifest(): ?string
    {
        return $this->video->stream;
    }

    protected function getTimeCode(): ?float
    {
        return $this->getVideo()->timeCodeFor(auth()->user());
    }
}
