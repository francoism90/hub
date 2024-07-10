<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Playlists\Models\Playlist;
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
        if (! $user = auth()->user()) {
            return;
        }

        $playlist = Playlist::findByName($user, 'history');

        $this->authorize('update', $playlist);

        $this->video->markWatched($user, $time);
    }

    protected function getManifest(): ?string
    {
        return $this->video->stream;
    }

    protected function getStartTime(): ?float
    {
        if (! $user = auth()->user()) {
            return 0;
        }

        $playlist = Playlist::findByName($user, 'history');

        $this->authorize('view', $playlist);

        $model = $playlist?->videos()->find($this->video);

        return data_get($model?->pivot?->options ?: [], 'timestamp', 0);
    }
}
