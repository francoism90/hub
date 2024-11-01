<?php

declare(strict_types=1);

namespace App\Web\Tags\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithPaginateScroll;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Section extends Component
{
    use WithoutUrlPagination;
    use WithPaginateScroll;

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

    protected function getBuilder(): Paginator
    {
        return $this->getQuery()
            ->type($this->type)
            ->simplePaginate(
                perPage: $this->getCandidatesLimit(),
                page: $this->getPage(),
            );
    }

    protected function getCandidatesLimit(): int
    {
        return 9;
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
