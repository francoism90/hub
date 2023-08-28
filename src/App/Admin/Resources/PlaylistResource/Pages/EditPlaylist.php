<?php

namespace App\Admin\Resources\PlaylistResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\PlaylistResource;
use App\Admin\Resources\PlaylistResource\Forms\GeneralForm;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPlaylist extends EditRecord
{
    use InteractsWithFormData;

    protected static string $resource = PlaylistResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                ...GeneralForm::make(),
            ]);
    }

    public function getTitle(): string|Htmlable
    {
        return static::getRecordTitle();
    }

    public function getContentTabLabel(): ?string
    {
        return __('General');
    }

    public function getBreadcrumb(): string
    {
        return __('Manage');
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
