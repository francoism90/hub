<?php

namespace Support\FFMpeg\Format\Subtitle;

use FFMpeg\Format\Video\DefaultVideo;

/**
 * The WebVTT subtitle format.
 */
class WebVTT extends DefaultVideo
{
    public function __construct($audioCodec = 'copy', $videoCodec = 'copy')
    {
        $this
            ->setAudioCodec($audioCodec)
            ->setVideoCodec($videoCodec);
    }

    /**
     * {@inheritDoc}
     */
    public function supportBFrames()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtraParams()
    {
        return ['-f', 'webvtt'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableAudioCodecs()
    {
        return ['copy'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableVideoCodecs()
    {
        return ['copy'];
    }
}
