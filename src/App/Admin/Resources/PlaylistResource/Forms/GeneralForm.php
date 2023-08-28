<?php

namespace App\Admin\Resources\PlaylistResource\Forms;

use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->required()
            ->maxLength(255);
    }

    public static function make(): array
    {
        return [
            static::name(),
        ];
    }
}
