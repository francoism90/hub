<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use App\Filament\Resources\RelatableResource\Forms\GeneralForm;
use App\Filament\Resources\RelatableResource\Tables\GeneralListing;
use App\Filament\Resources\TagResource\Pages\EditTag;
use Domain\Relates\Models\Relatable;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelatablesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatables';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                ...GeneralForm::make(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ...GeneralListing::make(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ViewAction::make()
                    ->url(fn (Relatable $record): string => EditTag::getUrl([$record->relate])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
