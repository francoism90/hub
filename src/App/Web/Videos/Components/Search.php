<?php

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public ?string $search = null;

    public function render(): View
    {
        return view('videos::search', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Collection
    {
        if (blank($this->search)) {
            return collect();
        }

        return Video::query()
            ->with('tags')
            ->when(filled($this->search), function (Builder $query) {
                $models = Video::search($this->search)->take(12);

                return $query
                    ->whereIn('id', $models->keys())
                    ->orderByRaw("FIELD ('id', {$models->keys()->implode(',')})");
            })
            ->get();
    }
}
