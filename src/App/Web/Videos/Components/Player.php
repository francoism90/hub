<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\Support\Uri;
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
            'manifest' => $this->getManifestUrl(),
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
        if (! is_numeric($time) || ! auth()->check()) {
            return;
        }

        $this->getVideo()->modelCache('timecode', $time, now()->addWeeks(2));
    }

    protected function getManifestUrl(): Uri
    {
        return $this->video->stream;
    }

    protected function getTimeCode(): float
    {
        return $this->getVideo()->timeCode();
    }
}
