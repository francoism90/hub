<?php

namespace App\Web\Videos\Components;

use App\Web\Lists\Concerns\WithHistory;
use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Attributes\Session;
use Livewire\Component;

class Player extends Component
{
    use WithHistory;
    use WithVideo;

    #[Session]
    public ?string $caption = 'en';

    public function render(): View
    {
        return view('app.videos.player.view')->with([
            'manifest' => $this->getManifest(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.player.placeholder', $params);
    }

    public function updateHistory(?float $time = null): void
    {
        $this->authorize('update', $model = static::history());

        throw_unless($time >= 0 && $time <= ceil($this->video->duration));

        $model->attachVideo($this->video, [
            'timestamp' => round($time, 2),
        ]);
    }

    protected function getManifest(): ?string
    {
        return $this->video->stream;
    }

    protected function getStartsAt(): ?float
    {
        $model = static::history()
            ->videos()
            ->find($this->video);

        return data_get($model?->pivot?->options ?: [], 'timestamp', 0);
    }
}
