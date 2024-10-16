<?php

declare(strict_types=1);

namespace App\Web\Playlists\Controllers;

use App\Web\Groups\Concerns\WithGroups;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class PlaylistIndexController extends Page
{
    use WithGroups;

    public function render(): View
    {
        return view('app.playlists.index');
    }

    #[Computed(cache: true, key: 'tags')]
    public function types(): array
    {
        return collect(TagType::cases())
            ->reject(fn (TagType $type) => Tag::query()->type($type)->count() === 0)
            ->all();
    }

    protected function getTitle(): ?string
    {
        return __('Lists');
    }

    protected function getDescription(): ?string
    {
        return $this->getTitle();
    }
}
