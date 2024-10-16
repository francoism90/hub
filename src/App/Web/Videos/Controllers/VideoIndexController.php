<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class videoIndexController extends Page
{
    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.videos.index')->with([
            'items' => $this->getCollection(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();
    }

    protected function getCollection(): array
    {
        return [
            GroupSet::Daily,
            GroupSet::Discover,
        ];
    }

    protected function getTitle(): ?string
    {
        return __('Stream Videos');
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch videos');
    }
}
