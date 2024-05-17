<?php

namespace App\Tags\Http\Controllers;

use App\Livewire\Tags\Concerns\WithTags;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Meilisearch\Endpoints\Indexes;

#[Layout('components.layouts.app')]
class TagViewController extends Page
{
    use WithPagination;
    use WithQueryBuilder;
    use WithTags;

    public function render(): View
    {
        return view('livewire.app.pages.tags.view');
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $value = (string) $this->tag->name;

        return $this->getScout($value, function (Indexes $engine, string $query, array $options) {
            $options['attributesToSearchOn'] = ['tags'];

            return $engine->search($query, $options);
        })
            ->paginate(10 * 3);
    }

    public function onTagDeleted(): void
    {
        $this->dispatch('$refresh');
    }

    public function onTagUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getTitle(): string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): string
    {
        return (string) $this->tag->description;
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
