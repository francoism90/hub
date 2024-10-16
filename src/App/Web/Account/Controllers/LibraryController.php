<?php

declare(strict_types=1);

namespace App\Web\Account\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class LibraryController extends Page
{
    public function render(): View
    {
        return view('app.account.library');
    }

    protected function getTitle(): ?string
    {
        return __('Library');
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch your videos');
    }
}
