<?php

declare(strict_types=1);

namespace App\Web\Groups\Components;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Groups\Forms\QueryForm;
use App\Web\Groups\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithAuthentication;
    use WithGroup;
    use WithQueryBuilder;
    use WithPagination;

    #[Modelable]
    public QueryForm $form;

    public function render(): View
    {
        return view('app.videos.items.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.items.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    #[Computed(persist: true, seconds: 60 * 60 * 24)]
    public function items(): Paginator
    {
        return $this->getGroup()
            ->videos()
            ->tap(new FilterVideos($this->form, $this->group))
            ->simplePaginate(perPage: 16);
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
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
