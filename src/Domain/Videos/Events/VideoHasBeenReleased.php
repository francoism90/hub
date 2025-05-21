<?php

declare(strict_types=1);

namespace Domain\Videos\Events;

use Domain\Videos\Models\Video;
use Illuminate\Queue\SerializesModels;

class VideoHasBeenReleased
{
    use SerializesModels;

    public function __construct(public Video $video) {}
}
