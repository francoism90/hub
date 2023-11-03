<?php

namespace App\Filament\Resources\MediaResource\Forms;

use Filament\Forms\Components\KeyValue;

abstract class MetaForm
{
    public static function properties(): KeyValue
    {
        return KeyValue::make('custom_properties')
            ->label(__('Properties'))
            ->nullable();
    }

    public static function manipulations(): KeyValue
    {
        return KeyValue::make('manipulations')
            ->label(__('Manipulations'))
            ->nullable();
    }

    public static function make(): array
    {
        return [
            static::properties(),
            static::manipulations(),
        ];
    }
}
