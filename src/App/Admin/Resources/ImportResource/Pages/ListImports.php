<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Resources\ImportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImports extends ListRecords
{
    protected static string $resource = ImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
