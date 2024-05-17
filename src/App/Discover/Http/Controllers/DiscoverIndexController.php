<?php

namespace App\Discover\Http\Controllers;

use App\Livewire\Discover\Forms\QueryForm;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class DiscoverIndexController extends Page
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function render(): View
    {
        return view('livewire.app.pages.discover.index');
    }

    public function mount(): void
    {
        $this->form->restore();
    }

    public function updated(): void
    {
        $this->form->submit();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }

    protected function getTitle(): string
    {
        return __('Discover');
    }
}
