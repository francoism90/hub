<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Edit\General;
use App\Livewire\Dashboard\Videos\Edit\Similar;
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

    #[Url(as: 'tab', except: 'general', history: true)]
    public string $tab = 'general';

    public function render(): View
    {
        return view('livewire.dashboard.videos.edit')->with([
            'actions' => $this->actions(),
            'tabs' => $this->tabs(),
            'current' => $this->currentTab(),
        ]);
    }

    public function delete(): void
    {
        $this->canDelete($this->video);

        $this->video->deleteOrFail();

        $this->redirect(ContentController::class, true);
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

            Action::make('similar')
                ->label(__('Similar'))
                ->component(Similar::class),
        ];
    }

    protected function actions(): array
    {
        return [
            Action::make('delete')
                ->label(__('Delete'))
                ->componentAttributes([
                    'wire:click' => 'delete',
                    'wire:confirm' => __('Are you sure you want to delete this video?'),
                ]),

            Action::make('download')
                ->label(__('Download'))
                ->componentAttributes([
                    'href' => $this->video->clips()->first()?->getUrl(),
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

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
