<?php

namespace App\Web\Search\Controllers;

use Illuminate\View\View;
use Livewire\Component;

class SearchIndexController extends Component
{
    public function render(): View
    {
        return view('search::index');
    }
}
