<?php

namespace App\Filament\Resources\ImportResource\Pages;

use App\Filament\Concerns\InteractsWithState;
use App\Filament\Resources\ImportResource;
use App\Filament\Resources\ImportResource\Actions\BulkImportAction;
use App\Filament\Resources\ImportResource\Actions\ImportAction;
use App\Filament\Resources\ImportResource\Actions\SyncAction;
use Domain\Imports\States\ImportState;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Number;

class ListImports extends ListRecords
{
    use InteractsWithState;

    protected static string $resource = ImportResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->poll()
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('file_name')
                    ->label(__('Filename'))
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('size')
                    ->label(__('Filesize'))
                    ->formatStateUsing(fn (mixed $state) => Number::fileSize($state, precision: 2))
                    ->sortable(),

                Columns\TextColumn::make('state')
                    ->formatStateUsing(fn (ImportState $state): string => $state->label())
                    ->icon(fn (ImportState $state): string => $state->icon())
                    ->color(fn (ImportState $state): string => $state->color())
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
                ImportAction::make()
                    ->icon('heroicon-o-plus'),
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
        return __('Sync');
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
