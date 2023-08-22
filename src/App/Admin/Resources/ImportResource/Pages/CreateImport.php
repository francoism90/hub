<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Resources\ImportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateImport extends CreateRecord
{
    protected static string $resource = ImportResource::class;
}
