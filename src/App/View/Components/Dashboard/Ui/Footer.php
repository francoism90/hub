<?php

namespace App\View\Components\Dashboard\Ui;

use Closure;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.dashboard.ui.footer');
    }
}
