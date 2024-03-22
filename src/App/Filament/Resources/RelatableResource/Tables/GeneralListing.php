<?php

namespace App\Filament\Resources\RelatableResource\Tables;

use Filament\Tables\Columns\TextColumn;

class GeneralListing
{
    public static function make(): array
    {
        return [
            static::relatable(),
            static::score(),
            static::boost(),
            static::created(),
            static::updated(),
        ];
    }

    public static function relatable(): TextColumn
    {
        return TextColumn::make('relate.name')
            ->label(__('Relates To'))
            ->limit()
            ->searchable()
            ->sortable();
    }

    public static function score(): TextColumn
    {
        return TextColumn::make('score')
            ->label(__('Score'))
            ->numeric(decimalPlaces: 2)
            ->limit()
            ->searchable()
            ->sortable();
    }

    public static function boost(): TextColumn
    {
        return TextColumn::make('boost')
            ->label(__('Boost'))
            ->numeric(decimalPlaces: 2)
            ->limit()
            ->searchable()
            ->sortable();
    }

    public static function created(): TextColumn
    {
        return TextColumn::make('created_at')
            ->label(__('Created At'))
            ->dateTime()
            ->toggleable(isToggledHiddenByDefault: true)
            ->sortable();
    }

    public static function updated(): TextColumn
    {
        return TextColumn::make('updated_at')
            ->label(__('Updated At'))
            ->dateTime()
            ->toggleable(isToggledHiddenByDefault: true)
            ->sortable();
    }
}
