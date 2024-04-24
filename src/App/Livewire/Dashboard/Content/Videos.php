<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Illuminate\View\View;
use Livewire\Component;

class Videos extends Component
{
    public QueryForm $form;

    public function render(): View
    {
        return view('livewire.dashboard.content.videos')->with([
            // 'filters' => $this->filters(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }
}
