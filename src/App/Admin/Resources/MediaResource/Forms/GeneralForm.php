<?php

namespace App\Admin\Resources\MediaResource\Forms;

use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    public static function name(): TextInput
    {
        return TextInput::make('file_name')
            ->label(__('Filename'))
            ->required()
            ->disabled();
    }

    public static function make(): array
    {
        return [
            static::name(),
        ];
    }
}
