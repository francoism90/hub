<?php

namespace App\Filament\Resources\MediaResource\Tables;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Number;

class GeneralListing
{
    public static function make(): array
    {
        return [
            static::fileName(),
            static::fileSize(),
            static::mimeType(),
            static::collection(),
            static::created(),
            static::updated(),
        ];
    }

    public static function fileName(): TextColumn
    {
        return TextColumn::make('file_name')
            ->limit()
            ->searchable()
            ->sortable();
    }

    public static function fileSize(): TextColumn
    {
        return TextColumn::make('size')
            ->label(__('Size'))
            ->sortable()
            ->formatStateUsing(fn (int $state) => Number::fileSize($state, precision: 2))
            ->toggleable(isToggledHiddenByDefault: false);
    }

    public static function mimeType(): TextColumn
    {
        return TextColumn::make('mime_type')
            ->label(__('Mime Type'))
            ->searchable()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: false);
    }

    public static function collection(): TextColumn
    {
        return TextColumn::make('collection_name')
            ->label(__('Collection'))
            ->searchable()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);
    }

    public static function disk(): TextColumn
    {
        return TextColumn::make('disk')
            ->searchable()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);
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
