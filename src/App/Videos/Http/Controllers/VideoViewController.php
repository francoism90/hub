<?php

namespace App\Videos\Http\Controllers;

use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.simple')]
class VideoViewController extends Page
{
    use WithHistory;
    use WithVideos;

    public function render(): View
    {
        return view('livewire.app.videos.view');
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
