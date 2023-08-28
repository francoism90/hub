<?php

namespace App\Admin\Resources\PlaylistResource\Pages;

use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\PlaylistResource;
use Domain\Playlists\States\PlaylistState;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListPlaylists extends ListRecords
{
    use InteractsWithScout;

    protected static string $resource = PlaylistResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('state')
                    ->label(__('State'))
                    ->formatStateUsing(fn (PlaylistState $state) => $state->label())
                    ->icon(fn (PlaylistState $state): string => match ($state->getValue()) {
                        'pending' => 'heroicon-o-minus-circle',
                        'verified' => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (PlaylistState $state): string => match ($state->getValue()) {
                        'pending' => 'gray',
                        'verified' => 'success',
                        default => 'warning',
                    })
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create playlist')),
        ];
    }
}
