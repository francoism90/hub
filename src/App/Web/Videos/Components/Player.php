<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Component;

class Player extends Component
{
    use WithVideo;

    #[Session]
    public ?string $caption = 'en';

    public function render(): View
    {
        return view('app.videos.player.container')->with([
            'manifest' => $this->getManifest(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.player.placeholder', $params);
    }

    protected function getManifest(): ?string
    {
        return $this->video->stream;
    }
}
