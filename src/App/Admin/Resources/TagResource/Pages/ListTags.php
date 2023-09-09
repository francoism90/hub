<?php

namespace App\Admin\Resources\TagResource\Pages;

use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\TagResource;
use App\Admin\Resources\TagResource\Actions\SortAction;
use Domain\Tags\Enums\TagType;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListTags extends ListRecords
{
    use InteractsWithScout;
    use Translatable;

    protected static string $resource = TagResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->columns([
                Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->formatStateUsing(fn (TagType $state): ?string => $state?->label)
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
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            SortAction::make(),

            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create tag')),
        ];
    }
}
