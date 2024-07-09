<?php

namespace App\Web\Videos\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class FeedController extends Page
{
    public function render(): View
    {
        return view('app.videos.feed');
    }
}
