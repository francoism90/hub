<?php

declare(strict_types=1);

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTags;
use Domain\Tags\Enums\TagType;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class TagIndexController extends Page
{
    use WithTags;

    public function render(): View
    {
        return view('app.tags.index');
    }

    #[Computed(cache: true, key: 'tags')]
    public function types(): array
    {
        return collect(TagType::cases())->all();
    }

    protected function getTitle(): ?string
    {
        return __('Tags');
    }

    protected function getDescription(): ?string
    {
        return __('Browse all tags');
    }
}
