<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class VideoManagerController extends Page
{
    use WithAuthorization;
    use WithVideo;

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.content.video');
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
