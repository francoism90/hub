<?php

namespace App\Web\Lists\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
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
        return view('app.lists.tags.view')->with([
            'title' => $this->getTitle(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.tags.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getPageItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()
            ->withCount('videos')
            ->type($this->type)
            ->orderByDesc('videos_count')
            ->paginate(perPage: 9, page: $page);
    }

    protected function getTitle(): ?string
    {
        return $this->type->label();
    }

    protected function getModelClass(): ?string
    {
        return Tag::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
