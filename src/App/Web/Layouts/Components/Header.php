<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    public function render(): View
    {
        return view('layouts::header');
    }

    public function active(string $name, ?string $class = null): string
    {
        return request()->routeIs($name)
            ? implode(' ', [$class, 'navbar-item-active'])
            : $class;
    }
}
