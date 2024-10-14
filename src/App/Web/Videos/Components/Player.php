<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Activities\Actions\MarkAsViewed;
use Domain\Activities\Jobs\ProcessViewed;
use Domain\Groups\Actions\SyncVideoTimeCode;
use Illuminate\View\View;
use Livewire\Attributes\Renderless;
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

    #[Renderless]
    public function syncSession(?float $time = null): void
    {
        if ((! $user = auth()->user())) {
            return;
        }

        ProcessViewed::dispatchSync($user, $this->getVideo(), [
            'caption' => $this->caption,
            'time' => $time,
        ]);
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
