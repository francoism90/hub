<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Resources\ImportResource;
use Domain\Imports\Actions\SyncImports;
use Domain\Imports\Enums\ImportType;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ListImports extends ListRecords
{
    protected static string $resource = ImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->syncFormAction(),
        ];
    }

    protected function syncFormAction(): Action
    {
        return Action::make('scan')
            ->label(__('Scan'))
            ->icon('heroicon-o-archive-box')
            ->action(fn () => app(SyncImports::class)->execute(ImportType::video()));
    }
}
