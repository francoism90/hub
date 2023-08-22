<?php

namespace App\Admin\Resources\UserResource\Pages;

use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\UserResource;
use Domain\Users\States\Pending;
use Domain\Users\States\UserState;
use Domain\Users\States\Verified;
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
            ->deferLoading()
            ->columns([
                Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(),

                Columns\TextColumn::make('email')
                    ->sortable()
                    ->limit(),

                Columns\TextColumn::make('state')
                    ->formatStateUsing(fn (UserState $state) => $state->label())
                    ->icon(fn (UserState $state): string => match ($state->getValue()) {
                        Pending::class => 'heroicon-o-minus-circle',
                        Verified::class => 'heroicon-o-check-circle',
                        default => 'heroicon-o-x-circle',
                    })
                    ->color(fn (UserState $state): string => match ($state->getValue()) {
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
                Tables\Actions\CreateAction::make(),
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
