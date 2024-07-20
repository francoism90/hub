<?php

namespace App\Web\Lists\Controllers;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class ListIndexController extends Page
{
    public function render(): View
    {
        return view('app.lists.index');
    }

    #[Computed(cache: true, key: 'tag-types')]
    public function types(): array
    {
        return collect(TagType::cases())
            ->reject(fn (TagType $type) => Tag::query()->type($type)->count() === 0)
            ->all();
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
