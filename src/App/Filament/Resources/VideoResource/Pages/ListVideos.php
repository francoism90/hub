<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Concerns\InteractsWithScout;
use App\Filament\Resources\VideoResource;
use App\Filament\Resources\VideoResource\Filters\StateFilter;
use App\Filament\Resources\VideoResource\Filters\UntaggedFilter;
use Domain\Videos\States\VideoState;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ListVideos extends ListRecords
{
    use InteractsWithScout;
    use Translatable;

    protected static string $resource = VideoResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->poll()
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
                    ->formatStateUsing(fn (VideoState $state): string => $state->label())
                    ->icon(fn (VideoState $state): string => $state->icon())
                    ->color(fn (VideoState $state): string => $state->color())
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
                UntaggedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label(__('View'))
                    ->color('gray')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Model $record) => route('videos.view', $record)),
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
