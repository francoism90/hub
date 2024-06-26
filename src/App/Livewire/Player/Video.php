<?php

namespace App\Livewire\Player;

use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Component;

class Video extends Component
{
    use WithHistory;
    use WithVideos;

    #[Session]
    public bool $captions = true;

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
                ->icon('heroicon-s-arrow-left-circle')
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
                ->icon('heroicon-s-pause')
                ->iconActive('heroicon-s-play')
                ->state('paused')
                ->componentAttributes([
                    'x-on:click' => 'togglePlayback',
                ]),

            Action::make('backward')
                ->label(__('Backward'))
                ->icon('heroicon-s-backward')
                ->componentAttributes([
                    'x-on:click' => 'backward',
                ]),

            Action::make('forward')
                ->label(__('Forward'))
                ->icon('heroicon-s-forward')
                ->componentAttributes([
                    'x-on:click' => 'forward',
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

            Action::make('captions')
                ->label(__('Captions'))
                ->icon('heroicon-o-bars-3-bottom-left')
                ->componentAttributes([
                    'x-cloak',
                    'x-show' => 'player?.getTextTracks().length',
                    'x-on:click' => 'toggleDialog(0)',
                ]),

            Action::make('toggle-fullscreen')
                ->state('fullscreen')
                ->label(__('Toggle Fullscreen'))
                ->icon('heroicon-o-arrows-pointing-out')
                ->iconActive('heroicon-o-arrows-pointing-in')
                ->componentAttributes([
                    'x-on:click' => 'toggleFullscreen',
                ]),
        ];
    }
}
