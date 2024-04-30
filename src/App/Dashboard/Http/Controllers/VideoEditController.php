<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Navigation\Concerns\WithNavigation;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class VideoEditController extends Page
{
    use WithAuthorization;
    use WithNavigation;
    use WithVideo;

    #[Url(as: 'tab', except: 'general', history: true)]
    public string $tab = 'general';

    public function render(): View
    {
        return view('livewire.dashboard.pages.videos.edit');
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    protected function navigation(): array
    {
        return [
            Action::make('general')
                ->label(__('General'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2'),

            Action::make('assets')
                ->label(__('Assets'))
                ->icon('heroicon-o-rectangle-stack')
                ->iconActive('heroicon-s-rectangle-stack'),
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
