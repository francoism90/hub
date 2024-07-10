<?php

namespace App\Web\Lists\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Section extends Component
{
    use WithAuthentication;
    use WithQueryBuilder;

    #[Locked]
    public TagType $type;

    public function render(): View
    {
        return view('app.lists.tags.view')->with([
            'title' => $this->getTitle(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.tags.placeholder', $params);
    }

    #[Computed]
    public function items(): Collection
    {
        return $this->getQuery()
            ->withCount('videos')
            ->type($this->type)
            ->take(12)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return $this->type->label();
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
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
