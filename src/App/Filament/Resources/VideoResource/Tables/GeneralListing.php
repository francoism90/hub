<?php

namespace App\Filament\Resources\VideoResource\Tables;

use Domain\Videos\States\VideoState;
use Filament\Tables\Columns\TextColumn;

class GeneralListing
{
    public static function make(): array
    {
        return [
            static::name(),
            static::identifier(),
            static::state(),
            static::created(),
            static::updated(),
        ];
    }

    public static function name(): TextColumn
    {
        return TextColumn::make('name')
            ->label(__('Name'))
            ->limit()
            ->searchable()
            ->sortable();
    }

    public static function identifier(): TextColumn
    {
        return TextColumn::make('identifier')
            ->label(__('ID'))
            ->limit()
            ->searchable()
            ->sortable(['season', 'episode', 'part']);
    }

    public static function state(): TextColumn
    {
        return TextColumn::make('state')
            ->label(__('State'))
            ->formatStateUsing(fn (VideoState $state): string => $state->label())
            ->icon(fn (VideoState $state): string => $state->icon())
            ->color(fn (VideoState $state): string => $state->color())
            ->toggleable(isToggledHiddenByDefault: false)
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
