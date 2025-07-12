<?php

declare(strict_types=1);

namespace Support\FFMpeg\Format\Video;

use FFMpeg\Format\Video\WebM as DefaultVideo;

class AOMedia extends DefaultVideo
{
    public function getAvailableAudioCodecs()
    {
        return ['copy', 'libopus'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableVideoCodecs()
    {
        return ['copy', 'libaom-av1'];
    }
}
