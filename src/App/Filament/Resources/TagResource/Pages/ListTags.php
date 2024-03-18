<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Concerns\InteractsWithScout;
use App\Filament\Resources\TagResource;
use App\Filament\Resources\TagResource\Actions\SortAction;
use Domain\Tags\Enums\TagType;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListTags extends ListRecords
{
    use InteractsWithScout;
    use Translatable;

    protected static string $resource = TagResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->poll()
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->modifyQueryUsing(fn (Builder $query) => $query->withCount('videos'))
            ->columns([
                Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->formatStateUsing(fn (TagType $state): string => $state->label())
                    ->sortable(),

                Columns\TextColumn::make('description')
                    ->label(__('Description'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit()
                    ->wrap()
                    ->sortable(),

                Columns\TextColumn::make('videos_count')
                    ->label(__('Usage'))
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
                Filters\SelectFilter::make('type')
                    ->options(fn () => collect(TagType::cases())->mapWithKeys(fn (TagType $item) => [
                        $item->value => $item->label(),
                    ])),

                Filters\TernaryFilter::make('adult'),
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

            SortAction::make()
                ->color('gray'),

            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create tag')),
        ];
    }
}
