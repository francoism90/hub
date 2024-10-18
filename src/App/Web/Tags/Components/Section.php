<?php

declare(strict_types=1);

namespace App\Web\Tags\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Section extends Component
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    #[Locked]
    public TagType $type;

    public function render(): View
    {
        return view('app.tags.section.view')->with([
            'title' => $this->getTitle(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.tags.section.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getBuilder(): Builder
    {
        return $this->getQuery();
    }

    public function getScrollPerPage(): int
    {
        return 9;
    }

    public function getScrollPageLimit(): ?int
    {
        return 10;
    }

    protected function getModelClass(): ?string
    {
        return Tag::class;
    }

    protected function getTitle(): ?string
    {
        return $this->type->label();
    }
}
