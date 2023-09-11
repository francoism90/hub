<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Concerns\InteractsWithState;
use App\Admin\Resources\ImportResource;
use App\Admin\Resources\ImportResource\Actions\BulkImportAction;
use App\Admin\Resources\ImportResource\Actions\ImportAction;
use App\Admin\Resources\ImportResource\Actions\SyncAction;
use Domain\Imports\States\ImportState;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

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
                    ->label(__('Filename'))
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('size')
                    ->label(__('Filesize'))
                    ->formatStateUsing(fn (mixed $state) => human_filesize($state))
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
                ImportAction::make(),
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

    public function getTitle(): string|Htmlable
    {
        return __('Import Videos');
    }

    protected function getHeaderActions(): array
    {
        return [
            BulkImportAction::make()
                ->color('gray'),

            SyncAction::make()
                ->color('gray'),
        ];
    }
}
