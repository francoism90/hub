<?php

namespace App\Admin\Resources\MediaResource\Pages;

use App\Admin\Resources\MediaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                Columns\TextColumn::make('file_name')
                    ->label(__('Filename'))
                    ->limit()
                    ->sortable(),

                Columns\TextColumn::make('size')
                    ->label(__('Filesize'))
                    ->formatStateUsing(fn (mixed $state) => human_filesize($state))
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
                EditAction::make(),
                ViewAction::make(),
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
