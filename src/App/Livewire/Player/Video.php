<?php

namespace App\Livewire\Player;

use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithVideos;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            'actions' => $this->actions(),
            'controls' => $this->controls(),
            'settings' => $this->settings(),
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
                ->componentAttributes([
                    'x-modelable' => 'paused',
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
