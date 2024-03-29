<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Concerns\InteractsWithScout;
use App\Filament\Resources\UserResource;
use Domain\Users\States\UserState;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;

class ListUsers extends ListRecords
{
    use InteractsWithScout;

    protected static string $resource = UserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->poll()
            ->defaultSort('created_at', 'desc')
            ->columns([
                Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(),

                Columns\TextColumn::make('email')
                    ->sortable()
                    ->limit(),

                Columns\TextColumn::make('state')
                    ->formatStateUsing(fn (UserState $state): string => $state->label())
                    ->icon(fn (UserState $state): string => $state->icon())
                    ->color(fn (UserState $state): string => $state->color())
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

                Columns\TextColumn::make('email_verified_at')
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
                //
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->button()
                ->icon('heroicon-o-plus')
                ->label(__('Create user')),
        ];
    }
}
