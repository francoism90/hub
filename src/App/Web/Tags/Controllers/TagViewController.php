<?php

declare(strict_types=1);

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class TagViewController extends Page
{
    use WithTag;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.tags.view')->with([
            'items' => $this->getCollection(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->validate();
    }

    protected function getCollection(): array
    {
        return [
            GroupSet::Latest,
            GroupSet::Longest,
            GroupSet::Shortest,
        ];
    }

    protected function getTitle(): ?string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->tag->description;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
