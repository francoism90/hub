<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Concerns\InteractsWithState;
use App\Admin\Resources\ImportResource;
use Domain\Imports\Actions\BulkImport;
use Domain\Imports\Actions\SyncImports;
use Domain\Imports\Enums\ImportType;
use Domain\Imports\Models\Import;
use Domain\Imports\States\Finished;
use Domain\Imports\States\ImportState;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ListImports extends ListRecords
{
    use InteractsWithState;

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
                        'finished' => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (ImportState $state): string => match ($state->getValue()) {
                        'pending' => 'gray',
                        'finished' => 'success',
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
                SelectFilter::make('state')
                    ->options(fn () => static::stateOptions(ImportState::class)),
            ])
            ->actions([
                $this->importAction(),
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
            $this->bulkImportAction(),
            $this->syncAction(),
        ];
    }

    protected function importAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('import')
            ->label(__('Import'))
            ->disabled(fn (Import $record) => $record->state->equals(Finished::class))
            ->action(fn (Import $record) => static::stateOptions($record));
    }

    protected function bulkImportAction(): Action
    {
        return Action::make('bulk_import')
            ->label(__('Import'))
            ->icon('heroicon-o-squares-plus')
            ->action(fn () => app(BulkImport::class)->execute(ImportType::video()));
    }

    protected function syncAction(): Action
    {
        return Action::make('sync')
            ->label(__('Sync'))
            ->icon('heroicon-o-archive-box')
            ->action(fn () => app(SyncImports::class)->execute(ImportType::video()));
    }
}
