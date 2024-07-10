<?php

namespace App\Web\Lists\Controllers;

use Domain\Tags\Enums\TagType;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class ListIndexController extends Page
{
    public function render(): View
    {
        return view('app.lists.index')->with([
            'types' => $this->getTypes(),
        ]);
    }

    protected function getTypes(): array
    {
        return TagType::cases();
    }

    protected function getTitle(): ?string
    {
        return __('Lists');
    }

    protected function getDescription(): ?string
    {
        return $this->getTitle();
    }
}
