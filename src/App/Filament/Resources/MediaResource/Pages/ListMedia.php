<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->poll('10s')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('file_name')
                    ->label(__('Filename'))
                    ->limit()
                    ->sortable(),

                Columns\TextColumn::make('size')
                    ->label(__('Filesize'))
                    ->formatStateUsing(fn (mixed $state): string => human_filesize($state))
                    ->sortable(),

                Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                //
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
