<?php

namespace App\Web\Library\Controllers;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class LibraryIndexController extends Page
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('app.library.index');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.library.placeholder', $params);
    }

    #[Computed()]
    public function items(): Paginator
    {
        // $query = $this->form->query();

        return $this->getScout('')
            ->simplePaginate(12 * 4);
    }

    protected function getTitle(): ?string
    {
        return __('Library');
    }

    protected function getDescription(): ?string
    {
        return $this->getTitle();
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
