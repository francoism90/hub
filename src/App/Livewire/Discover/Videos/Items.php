<?php

namespace App\Livewire\Discover\Videos;

use App\Livewire\Discover\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithAuthentication;
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
        $value = $this->form->query();

        return $this->getScout($value)
            ->when(! $value, fn (Builder $query) => $query->whereIn('id', [0]))
            ->paginate(10 * 3);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
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
