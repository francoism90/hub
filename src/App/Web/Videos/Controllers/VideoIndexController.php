<?php

namespace App\Web\Videos\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoIndexController extends Page
{
    public function render(): View
    {
        return view('app.videos.index');
    }

    protected function getDescription(): ?string
    {
        return __('Subscription service for video content.');
    }
}
