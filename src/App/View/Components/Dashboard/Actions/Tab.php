<?php

namespace App\View\Components\Dashboard\Actions;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Tab extends Component
{
    public function __construct(
        public Action $action,
        public bool $active = false,
    ) {
    }

    public function render(): View
    {
        return view('components.dashboard.actions.tab');
    }
}
