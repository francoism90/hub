<?php

namespace Domain\Users\Concerns;

use Filament\Panel;

trait InteractsWithFilament
{
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('super-admin');
    }
}
