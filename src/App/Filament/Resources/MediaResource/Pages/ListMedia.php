<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Domain\Media\Models\Media;
use Domain\Videos\Models\Video;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions;
use Filament\Tables\Columns;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->poll('10s')
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(fn (Builder $query) => $query->has('model'))
            ->columns([
                Columns\TextColumn::make('file_name')
                    ->label(__('Filename'))
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('size')
                    ->label(__('Filesize'))
                    ->formatStateUsing(fn (mixed $state): string => Number::fileSize($state, precision: 2))
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
                Actions\ViewAction::make()
                    ->label(__('View'))
                    ->color('gray')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Media $record) => match(get_class($record->model)) {
                        Video::class => route('videos.view', $record->model),
                        default => null,
                    }),
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                //
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
