<?php

namespace App\Web\Layouts\Components;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public ?string $search = 'a';

    public function render(): View
    {
        return view('layouts::search', [
            'videos' => $this->videos(),
            'tags' => $this->tags(),
        ]);
    }

    protected function videos(): Collection
    {
        if (blank($this->search)) {
            return collect();
        }

        return Video::query()
            ->with('tags')
            ->when(filled($this->search), function (Builder $query) {
                $models = Video::search($this->search)->take(10);

                return $query
                    ->whereIn('id', $models->keys())
                    ->orderByRaw("FIELD ('id', {$models->keys()->implode(',')})");
            })
            ->get();
    }

    protected function tags(): Collection
    {
        if (blank($this->search)) {
            return collect();
        }

        return Tag::query()
            ->when(filled($this->search), function (Builder $query) {
                $models = Tag::search($this->search)->take(10);

                return $query
                    ->whereIn('id', $models->keys())
                    ->orderByRaw("FIELD ('id', {$models->keys()->implode(',')})");
            })
            ->get();
    }
}
