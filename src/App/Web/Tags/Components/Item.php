<?php

declare(strict_types=1);

namespace App\Web\Tags\Components;

use App\Web\Tags\Concerns\WithTag;
use Illuminate\View\View;
use Livewire\Component;

class Item extends Component
{
    use WithTag;

    public function render(): View
    {
        return view('app.tags.item.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.tags.item.placeholder', $params);
    }
}
