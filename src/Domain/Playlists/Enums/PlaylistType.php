<?php

namespace Domain\Playlists\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self system()
 * @method static self mixer()
 * @method static self private()
 * @method static self public()
 */
class PlaylistType extends Enum
{
    protected static function labels(): array
    {
        return [
            'system' => __('System'),
            'mixer' => __('Mixer'),
            'private' => __('Private'),
            'public' => __('Public'),
        ];
    }
}
