<?php

namespace App\Discover\Http\Controllers;

use App\Livewire\Discover\Forms\QueryForm;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DiscoverIndexController extends Page
{
    use WithAuthentication;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('livewire.app.pages.discover.index');
    }

    public function updated(): void
    {
        $this->form->submit();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    #[Computed(cache: true, key: 'taggables', seconds: 7200)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->withCount('videos')
            ->ordered()
            ->get()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->groupBy(fn (Tag $item) => str($item->name)->upper()->substr(0, 1));
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }

    protected function getTitle(): string
    {
        return __('Discover');
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
