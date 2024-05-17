<?php

namespace App\Livewire\Discover\Videos;

use App\Livewire\Discover\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Meilisearch\Endpoints\Indexes;

class Items extends Component
{
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function render(): View
    {
        return view('livewire.videos.items');
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $value = implode(' ', $this->form->only('search', 'tag'));

        return $this->getScout($value, function (Indexes $engine, string $query, array $options) {
            if ($this->form->filled('tag')) {
                $options['attributesToSearchOn'] = ['tags'];
            }

            return $engine->search($query, $options);
        })
        ->paginate(10 * 3);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }
}
