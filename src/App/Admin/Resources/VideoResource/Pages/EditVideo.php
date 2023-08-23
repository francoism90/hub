<?php

namespace App\Admin\Resources\VideoResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\VideoResource;
use Domain\Videos\Actions\RegenerateVideo;
use Domain\Videos\Models\Video;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;

class EditVideo extends EditRecord
{
    use InteractsWithFormData;
    use Translatable;

    protected static string $resource = VideoResource::class;

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            Actions\Action::make('regenerate')
                ->label(__('Regenerate'))
                ->icon('heroicon-o-document-check')
                ->action(fn (Video $record) => app(RegenerateVideo::class)->execute($record)),

            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\ForceDeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\RestoreAction::make()
                ->icon('heroicon-s-arrow-uturn-up'),
        ];
    }
}
