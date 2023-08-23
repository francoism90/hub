<?php

namespace App\Admin\Resources\VideoResource\RelationManagers;

use Domain\Media\Models\Media;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('collection_name')
                    ->required()
                    ->label(__('Collection'))
                    ->options($this
                        ->getOwnerRecord()
                        ->getRegisteredMediaCollections()
                        ->pluck('name', 'name')
                    ),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->recordTitleAttribute('name')
            ->columns([
                Columns\TextColumn::make('name')
                    ->limit()
                    ->searchable()
                    ->sortable(),

                Columns\TextColumn::make('collection_name')
                    ->label(__('Collection'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Columns\TextColumn::make('disk')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Columns\TextColumn::make('size')
                    ->formatStateUsing(fn (int $state) => human_filesize($state))
                    ->toggleable(isToggledHiddenByDefault: false),

                Columns\TextColumn::make('file_name')
                    ->label(__('Filename'))
                    ->limit()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Columns\TextColumn::make('mime_type')
                    ->label(__('Mime Type'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label(__('Download'))
                    ->icon('heroicon-s-arrow-down-circle')
                    ->url(fn (Media $media) => $media->getUrl()),
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
}
