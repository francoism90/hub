<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Resources\ImportResource;
use Domain\Imports\Actions\SyncImports;
use Domain\Imports\Enums\ImportType;
use Domain\Imports\Models\Import;
use Domain\Imports\States\ImportState;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;

class ListImports extends ListRecords
{
    protected static string $resource = ImportResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('file_name')
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('name')
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->formatStateUsing(fn (ImportType $state): ?string => $state?->label)
                    ->sortable(),

                Columns\TextColumn::make('state')
                    ->formatStateUsing(fn (ImportState $state) => $state->label())
                    ->icon(fn (ImportState $state): string => match ($state->getValue()) {
                        'pending' => 'heroicon-o-minus-circle',
                        'verified' => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (ImportState $state): string => match ($state->getValue()) {
                        'pending' => 'gray',
                        'verified' => 'success',
                        default => 'warning',
                    })
                    ->sortable(),

                Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Columns\TextColumn::make('finished_at')
                    ->label(__('Finished At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                //
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->syncAction(),
        ];
    }

    protected function importAction(): Action
    {
        return Action::make('import')
            ->label(__('Import'))
            ->icon('heroicon-o-archive-box')
            ->action(fn (Import $record) => app(SyncImports::class)->execute(ImportType::video()));
    }

    protected function syncAction(): Action
    {
        return Action::make('sync')
            ->label(__('Sync'))
            ->icon('heroicon-o-archive-box')
            ->action(fn () => app(SyncImports::class)->execute(ImportType::video()));
    }
}
