<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Panels\General;
use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class VideoManagerController extends Page
{
    use WithAuthorization;
    use WithVideo;

    #[Url(as: 'tab', except: 'general')]
    public string $tab = 'general';

    public function render(): View
    {
        return view('livewire.dashboard.pages.content.video')->with([
            'navigation' => $this->navigation(),
        ]);
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    protected function navigation(): Navigation
    {
        return Navigation::make()
            ->active($this->tab)
            ->add('general', fn (NavigationItem $item) => $item
                ->wireModel('tab')
                ->label(__('General'))
                ->livewire(General::class)
            )
            ->add('assets', fn (NavigationItem $item) => $item
                ->wireModel('tab')
                ->label(__('Assets'))
                // ->livewire(Tags::class)
            );
    }

    protected function getTitle(): string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->video->summary;
    }
}
