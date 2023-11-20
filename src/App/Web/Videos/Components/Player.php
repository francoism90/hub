<?php

namespace App\Web\Videos\Components;

use App\Web\Playlists\Concerns\WithHistory;
use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Player extends Component
{
    use WithHistory;
    use WithVideo;

    public bool $controls = true;

    public function render(): View
    {
        return view('videos::player');
    }

    #[Computed]
    public function manifest(): string
    {
        return $this->video->stream;
    }

    #[Computed]
    public function starts(): float
    {
        $model = static::history()
            ->videos()
            ->find($this->video);

        return data_get($model?->pivot->options, 'timestamp', 0);
    }

}
