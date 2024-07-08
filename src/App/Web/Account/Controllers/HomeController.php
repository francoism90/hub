<?php

namespace App\Web\Account\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class HomeController extends Page
{
    public function render(): View
    {
        return view('app.account.home');
    }
}
