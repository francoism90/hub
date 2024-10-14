<?php

declare(strict_types=1);

namespace App\Web\Library\Components;

use App\Web\Library\Forms\QueryForm;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Feed extends Component
{
    #[Modelable]
    public QueryForm $form;

    public function render(): View
    {
        return view('app.library.feed.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.library.feed.placeholder', $params);
    }
}
