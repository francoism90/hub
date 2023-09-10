<?php

namespace App\Web\Layouts\Composers;

use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $view->with('searchQuery', session('search_query'));
    }
}
