<?php

namespace App\Filament\Resources\VideoResource\Forms;

use Filament\Forms\Components\Checkbox;

abstract class FeatureForm
{
    public static function adult(): Checkbox
    {
        return Checkbox::make('adult')
            ->label(__('Adult Content'))
            ->nullable();
    }

    public static function make(): array
    {
        return [
            static::adult(),
        ];
    }
}
