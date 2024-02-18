<?php

namespace App\Filament\Resources\VideoResource\RelationManagers;

use App\Filament\Resources\MediaResource\Forms\MetaForm;
use App\Filament\Resources\MediaResource\Tables\GeneralListing;
use Domain\Media\Models\Media;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                ...MetaForm::make(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->poll()
            ->recordTitleAttribute('file_name')
            ->defaultSort('collection_name')
            ->columns([
                ...GeneralListing::make(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make('edit')
                    ->label(__('Edit'))
                    ->icon('heroicon-o-document'),

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
                //
            ]);
    }
}
