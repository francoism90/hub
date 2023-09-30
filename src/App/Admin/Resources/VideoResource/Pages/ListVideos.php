<?php

namespace App\Admin\Resources\VideoResource\Pages;

use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\VideoResource;
use App\Admin\Resources\VideoResource\Filters\StateFilter;
use Domain\Videos\States\VideoState;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ListVideos extends ListRecords
{
    use InteractsWithScout;
    use Translatable;

    protected static string $resource = VideoResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('identifier')
                    ->label(__('ID'))
                    ->limit()
                    ->searchable()
                    ->sortable(['season', 'episode', 'part']),

                Columns\TextColumn::make('state')
                    ->label(__('State'))
                    ->formatStateUsing(fn (VideoState $state) => $state->label())
                    ->icon(fn (VideoState $state): string => match ($state->getValue()) {
                        'pending' => 'heroicon-o-minus-circle',
                        'verified' => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (VideoState $state): string => match ($state->getValue()) {
                        'pending' => 'gray',
                        'verified' => 'success',
                        default => 'warning',
                    })
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
                StateFilter::make(),
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
            Actions\LocaleSwitcher::make(),

            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create video')),
        ];
    }
}
