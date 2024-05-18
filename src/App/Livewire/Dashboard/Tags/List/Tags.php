<?php

namespace App\Livewire\Dashboard\Tags\List;

use App\Livewire\Dashboard\Tags\Forms\QueryForm;
use App\Livewire\Dashboard\Tags\Scopes\ListTags;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('livewire.dashboard.content.tags')->with([
            'actions' => $this->actions(),
        ]);
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

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $query = $this->form->query();

        return $this->getScout($query)->tap(
            new ListTags(form: $this->form)
        )->paginate(12 * 3);
    }

    protected function actions(): array
    {
        return [
            //
        ];
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }
}
