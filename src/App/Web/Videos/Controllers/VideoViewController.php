<?php

namespace App\Web\Videos\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoViewController extends Page
{
    public function render(): View
    {
        return view('app.videos.view');
    }
}
