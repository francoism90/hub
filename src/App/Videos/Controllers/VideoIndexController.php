<?php

namespace App\Videos\Controllers;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithPagination;
    use WithoutUrlPagination;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('videos.index');
    }

    public function previous(): void
    {
        $this->previousPage();
    }

    public function next(): void
    {
        $this->nextPage();
    }

    #[Computed()]
    public function items()
    {
        return $this->getQuery()
            ->recommended()
            ->take(3)
            ->get();
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
