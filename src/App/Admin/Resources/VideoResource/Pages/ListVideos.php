<?php

namespace App\Admin\Resources\VideoResource\Pages;

use App\Admin\Resources\VideoResource;
use Domain\Videos\States\Pending;
use Domain\Videos\States\Verified;
use Domain\Videos\States\VideoState;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListVideos extends ListRecords
{
    use Translatable;

    protected static string $resource = VideoResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                Columns\TextColumn::make('name')
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('state')
                    ->formatStateUsing(fn (VideoState $state) => $state->label())
                    ->icon(fn (VideoState $state): string => match ($state->getValue()) {
                        Pending::class => 'heroicon-o-minus-circle',
                        Verified::class => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (VideoState $state): string => match ($state->getValue()) {
                        Pending::class => 'gray',
                        Verified::class => 'success',
                        default => 'warning',
                    })
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                Columns\TextColumn::make('updated_at')
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
            Actions\LocaleSwitcher::make(),

            Actions\Action::make('edit')
                ->button()
                ->icon('heroicon-o-squares-plus')
                ->label(__('Import videos'))
                ->url(fn (): string => route('filament.admin.resources.videos.import')),

            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create video')),
        ];
    }
}
