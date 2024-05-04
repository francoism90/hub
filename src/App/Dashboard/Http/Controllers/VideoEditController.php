<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Components\Edit\General;
use App\Livewire\Dashboard\Videos\States\VideoState;
use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithTabs;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class VideoEditController extends Page
{
    use WithTabs;
    use WithVideos;

    public VideoState $state;

    #[Url(as: 'tab', except: 'general', history: true)]
    public string $tab = 'general';

    public function mount(): void
    {
        $this->fillStateModel();
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.videos.edit')->with([
            'actions' => $this->actions(),
            'tabs' => $this->tabs(),
            'current' => $this->currentTab(),
        ]);
    }

    public function delete(): void
    {
        $this->canDelete($this->video);

        $this->video->deleteOrFail();
    }

    public function onVideoDeleted(): void
    {
        $this->dispatch('$refresh');
    }

    public function onVideoUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    protected function tabs(): array
    {
        return [
            Action::make('general')
                ->label(__('General'))
                ->component(General::class),

            Action::make('assets')
                ->label(__('Assets'))
                ->component(General::class),
        ];
    }

    protected function actions(): array
    {
        return [
            Action::make('delete')
                ->label(__('Delete'))
                ->componentAttributes([
                    'wire:click' => 'delete',
                    'wire:confirm' => __('Are you sure you want to delete this video?')
                ]),

            Action::make('view')
                ->label(__('View'))
                ->componentAttributes([
                    'wire:navigate' => true,
                    'href' => route('videos.view', $this->video),
                ]),
        ];
    }

    protected function getTitle(): string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->video->summary;
    }

    protected function fillStateModel(): void
    {
        $this->state->fill([
            'id' => $this->getVideoId(),
        ]);
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
