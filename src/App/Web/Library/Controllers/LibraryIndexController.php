<?php

declare(strict_types=1);

namespace App\Web\Library\Controllers;

use Domain\Groups\Actions\CreateSystemGroups;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class LibraryIndexController extends Page
{
    public function boot(): void
    {
        app(CreateSystemGroups::class)->execute($this->getAuthModel());
    }

    public function render(): View
    {
        return view('app.library.index');
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
