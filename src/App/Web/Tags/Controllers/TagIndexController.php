<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTags;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagIndexController extends Component
{
    use WithTags;
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = '';

    public function render(): View
    {
        return view('tags::index', [
            'items' => $this->builder(),
        ]);
    }


    protected function builder()
    {
        return Tag::query()
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search));
    }
}
