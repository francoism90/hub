<?php

namespace App\Livewire\Dashboard\Videos\States;

use Foxws\WireUse\States\Support\State;
use Livewire\Attributes\Locked;

class VideoState extends State
{
    #[Locked]
    public ?string $id = null;
}
