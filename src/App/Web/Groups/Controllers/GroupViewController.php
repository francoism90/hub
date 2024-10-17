<?php

declare(strict_types=1);

namespace App\Web\Groups\Controllers;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Groups\Forms\QueryForm;
use Domain\Groups\Enums\GroupMixer;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class GroupViewController extends Page
{
    use WithGroup;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.groups.view')->with([
            'title' => $this->getTitle(),
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
            GroupSet::Latest,
            GroupSet::Recommended,
        ];
    }

    protected function getTitle(): ?string
    {
        return (string) $this->group->name;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->group->content;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getGroupListeners(),
        ];
    }
}
