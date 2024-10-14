<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoIndexController extends Page
{
    public function render(): View
    {
        return view('app.videos.index');
    }

    protected function getTitle(): ?string
    {
        return 'Stream Videos';
    }

    protected function getDescription(): ?string
    {
        return __('Subscription service for video content.');
    }
}
