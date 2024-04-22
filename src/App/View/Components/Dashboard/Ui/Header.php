<?php

namespace App\View\Components\Dashboard\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Header extends Component
{
    public function render(): View
    {
        return view('components.dashboard.ui.header');
    }

    public function homeUrl(): Action
    {
        return Action::make()
            ->name(__('Home'))
            ->route('home');
    }
}
