<?php

namespace App\Admin\Resources\PlaylistResource\Pages;

use App\Admin\Resources\PlaylistResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePlaylist extends CreateRecord
{
    protected static string $resource = PlaylistResource::class;
}
