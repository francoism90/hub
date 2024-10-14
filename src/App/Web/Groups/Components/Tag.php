<?php

declare(strict_types=1);

namespace App\Web\Groups\Components;

use App\Web\Tags\Concerns\WithTag;
use Illuminate\View\View;
use Livewire\Component;

class Tag extends Component
{
    use WithTag;

    public function render(): View
    {
        return view('app.groups.tag.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.groups.tag.placeholder', $params);
    }
}
