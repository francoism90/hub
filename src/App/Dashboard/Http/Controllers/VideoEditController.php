<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Components\Edit\General;
use App\Livewire\Dashboard\Videos\States\VideoState;
use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Navigation\Concerns\WithTabs;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class VideoEditController extends Page
{
    use WithAuthorization;
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
            'tabs' => $this->tabs(),
            'current' => $this->currentTab(),
        ]);
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
