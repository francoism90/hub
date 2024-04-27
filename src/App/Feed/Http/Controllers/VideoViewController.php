<?php

namespace App\Feed\Http\Controllers;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.simple')]
class VideoViewController extends Page
{
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.pages.videos.view');
    }

    public function getListeners(): array
    {
        $id = $this->getVideoId();

        return [
            "echo-private:video.{$id},.video.deleted" => '$refresh',
            "echo-private:video.{$id},.video.updated" => '$refresh',
        ];
    }
}
