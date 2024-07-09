<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoViewController extends Page
{
    use WithVideo;

    public function render(): View
    {
        return view('app.videos.view');
    }
}
