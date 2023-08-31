<?php

namespace App\Admin\Resources\VideoResource\Forms;

use Filament\Forms\Components\Textarea;

abstract class ContentForm
{
    public static function summary(): Textarea
    {
        return Textarea::make('summary')
            ->label(__('Summary'))
            ->nullable()
            ->string()
            ->rows(6)
            ->cols(20);
    }

    public static function content(): Textarea
    {
        return Textarea::make('content')
            ->label(__('Content'))
            ->nullable()
            ->string()
            ->rows(6)
            ->cols(20);
    }

    public static function make(): array
    {
        return [
            static::summary(),
            static::content(),
        ];
    }
}
