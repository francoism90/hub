<?php

namespace App\Admin\Resources\VideoResource\Forms;

use App\Admin\Concerns\InteractsWithTags;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    use InteractsWithTags;

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Name'))
            ->required()
            ->autofocus()
            ->maxLength(255);
    }

    public static function season(): TextInput
    {
        return TextInput::make('season')
            ->label(__('Season'))
            ->nullable()
            ->maxLength(255);
    }

    public static function episode(): TextInput
    {
        return TextInput::make('episode')
            ->label(__('Episode'))
            ->nullable()
            ->maxLength(255);
    }

    public static function released(): DatePicker
    {
        return DatePicker::make('released_at')
            ->label(__('Released At'))
            ->nullable()
            ->native(false)
            ->seconds(false)
            ->placeholder('YYYY-MM-DD')
            ->displayFormat('Y-m-d')
            ->format('Y-m-d');
    }

    public static function id(): Grid
    {
        return Grid::make('episode')
            ->columns(3)
            ->label(__('Episode'))
            ->schema([
                static::season(),
                static::episode(),
                static::released(),
            ]);
    }

    public static function make(): array
    {
        return [
            static::name(),
            static::tags(),
            static::id(),
        ];
    }
}
