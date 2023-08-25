<?php

namespace App\Web\Videos\Concerns;

use Domain\Videos\Models\Video;
use Livewire\Attributes\Locked;

trait WithVideo
{
    #[Locked]
    public Video $video;
}
