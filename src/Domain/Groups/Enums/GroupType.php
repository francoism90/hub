<?php

declare(strict_types=1);

namespace Domain\Groups\Enums;

enum GroupType: string
{
    case System = 'system';
    case Private = 'private';
    case Public = 'public';
    case Mixer = 'mixer';

    public function label(): string
    {
        return match ($this) {
            self::System => __('System'),
            self::Mixer => __('Mixer'),
            self::Private => __('Private'),
            self::Public => __('Public'),
        };
    }
}
