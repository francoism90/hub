<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Panels\General;
use App\Livewire\Dashboard\Videos\States\VideoState;
use App\Livewire\Videos\Concerns\WithVideo;
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
    use WithVideo;

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
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2')
                ->livewire(General::class),

            Action::make('assets')
                ->label(__('Assets'))
                ->icon('heroicon-o-rectangle-stack')
                ->iconActive('heroicon-s-rectangle-stack')
                ->livewire(General::class),
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
        $this->state->fill($this->video);
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
