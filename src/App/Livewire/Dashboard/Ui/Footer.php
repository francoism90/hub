<?php

namespace App\Livewire\Dashboard\Ui;

use App\Livewire\Dashboard\States\DashboardFooterState;
use Livewire\Component;

class Footer extends Component
{
    public DashboardFooterState $state;

    public function render()
    {
        return view('livewire.dashboard.ui.footer');
    }
}
