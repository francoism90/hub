<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Concerns\InteractsWithScout;
use App\Filament\Resources\VideoResource;
use App\Filament\Resources\VideoResource\Filters\AdultFilter;
use App\Filament\Resources\VideoResource\Filters\StateFilter;
use App\Filament\Resources\VideoResource\Filters\UntaggedFilter;
use App\Filament\Resources\VideoResource\Tables\GeneralListing;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables;
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
                ...GeneralListing::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                StateFilter::make(),
                AdultFilter::make(),
                UntaggedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('show')
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
