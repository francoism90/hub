<?php

namespace App\Livewire\Player;

use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Videos\Concerns\WithVideos;
use Domain\Playlists\Models\Playlist;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Video extends Component
{
    use WithHistory;
    use WithVideos;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            'actions' => $this->actions(),
            'controls' => $this->controls(),
            'settings' => $this->settings(),
        ]);
    }

    #[Computed]
    public function startsAt(): float
    {
        $model = static::history()
            ->videos()
            ->find($this->video);

        return data_get($model?->pivot?->options ?: [], 'timestamp', 0);
    }

    public function updateHistory(?float $time = null): void
    {
        $this->authorize('update', $model = static::history());

        throw_unless($time >= 0 && $time <= ceil($this->video->duration));

        $model->attachVideo($this->video, [
            'timestamp' => round($time, 2),
        ]);
    }

    protected function actions(): array
    {
        return [
            Action::make('navigate')
                ->label(__('Go back'))
                ->icon('heroicon-m-arrow-left-circle')
                ->componentAttributes([
                    'onclick' => 'history.back()',
                    'title' => __('Go Back'),
                ]),
        ];
    }

    protected function controls(): array
    {
        return [
            Action::make('toggle-playback')
                ->label(__('Toggle Playback'))
                ->icon('heroicon-m-pause')
                ->iconActive('heroicon-m-play')
                ->state('paused')
                ->componentAttributes([
                    'x-on:click' => 'togglePlayback',
                ]),
        ];
    }

    protected function settings(): array
    {
        return [
            Action::make('edit')
                ->label(__('Manage Video'))
                ->icon('heroicon-o-book-open')
                ->route('dashboard.videos.edit', $this->video),

            Action::make('toggle-playback')
                ->label(__('Toggle Playback'))
                ->icon('heroicon-o-arrows-pointing-out')
                ->iconActive('heroicon-o-arrows-pointing-in')
                ->state('fullscreen')
                ->componentAttributes([
                    'x-on:click' => 'toggleFullscreen',
                ]),
        ];
    }
}
