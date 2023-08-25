<?php

namespace App\Web\Videos\Concerns;

use Domain\Videos\Models\Video;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;

trait WithVideo
{
    #[Locked]
    public Video | int | string | null $video;
}
