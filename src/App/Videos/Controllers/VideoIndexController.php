<?php

namespace App\Videos\Controllers;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    use WithQueryBuilder;

    public function render(): View
    {
        return view('videos.index');
    }

    public function updated(): void
    {
        //
    }

    public function refresh(): void
    {
        unset($this->item);
    }

    #[Computed]
    public function item(): ?Video
    {
        return $this->getQuery()
            ->published()
            ->inRandomOrder()
            ->first();
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
