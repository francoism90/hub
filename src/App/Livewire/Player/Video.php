<?php

namespace App\Livewire\Player;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithAuthentication;
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            'actions' => $this->actions(),
            'panel' => $this->panel(),
            'settings' => $this->settings(),
        ]);
    }

    protected function actions(): Actions
    {
        return Actions::make()
            ->add('previous', fn (Action $item) => $item
                ->label(__('Go back'))
                ->icon('heroicon-m-arrow-left-circle')
                ->bladeAttributes([
                    'onclick' => 'history.back()',
                    'title' => __('Go Back'),
                ])
            );
    }

    protected function panel(): Actions
    {
        return Actions::make()
            ->action($this->togglePlayAction());
    }

    protected function settings(): Actions
    {
        return Actions::make()
            ->actionIf(static::can('update', $this->video), $this->manage())
            ->action($this->toggleFullscreen());
    }

    protected function manage(): Action
    {
        return Action::make('edit')
            ->label(__('Manage Video'))
            ->icon('heroicon-o-book-open')
            ->route('dashboard.content.video', $this->video);
    }

    protected function togglePlayAction(): Action
    {
        return Action::make('toggle-playback')
            ->label(__('Toggle Playback'))
            ->icon('heroicon-m-pause')
            ->iconActive('heroicon-m-play')
            ->state('paused')
            ->bladeAttributes([
                'x-on:click' => 'togglePlayback',
            ]);
    }

    protected function toggleFullscreen(): Action
    {
        return Action::make('toggle-playback')
            ->label(__('Toggle Playback'))
            ->icon('heroicon-o-arrows-pointing-out')
            ->iconActive('heroicon-o-arrows-pointing-in')
            ->state('fullscreen')
            ->bladeAttributes([
                'x-on:click' => 'toggleFullscreen',
            ]);
    }
}
