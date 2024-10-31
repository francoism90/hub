<?php

declare(strict_types=1);

namespace App\Web\Tags\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Models\Concerns\WithScroll;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Section extends Component
{
    use WithoutUrlPagination;
    use WithPagination;
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

    public function updatedPage(): void
    {
        $this->fetch();
    }

    public function isFetchable(): bool
    {
        if ($this->items->isEmpty()) {
            return true;
        }

        return $this->getBuilder()->hasMorePages();
    }

    protected function getMergeCandidates(): Collection
    {
        return $this->getBuilder()->getCollection();
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
