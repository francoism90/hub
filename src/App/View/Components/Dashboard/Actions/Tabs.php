<?php

namespace App\View\Components\Dashboard\Actions;

use Foxws\WireUse\Actions\Support\Group;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Tabs extends Component
{
    public function __construct(
        public Group $items,
    ) {
    }

    public function render(): View
    {
        return view('components.dashboard.actions.tabs');
    }
}
