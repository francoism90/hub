<?php

namespace App\Feed\Http\Controllers;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

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
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
