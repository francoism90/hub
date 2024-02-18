<?php

namespace App\Filament\Resources\VideoResource\Filters;

use Filament\Tables\Filters\TernaryFilter;

class AdultFilter extends TernaryFilter
{
    public static function getDefaultName(): ?string
    {
        return 'adult';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Adult'));
    }
}
