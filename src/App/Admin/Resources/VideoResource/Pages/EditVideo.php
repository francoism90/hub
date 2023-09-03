<?php

namespace App\Admin\Resources\VideoResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\VideoResource;
use App\Admin\Resources\VideoResource\Forms\ContentForm;
use App\Admin\Resources\VideoResource\Forms\FeatureForm;
use App\Admin\Resources\VideoResource\Forms\GeneralForm;
use App\Admin\Resources\VideoResource\Forms\MediaForm;
use Domain\Videos\Actions\RegenerateVideo;
use Domain\Videos\Actions\UpdateVideoDetails;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditVideo extends EditRecord
{
    use InteractsWithFormData;
    use Translatable;

    protected static string $resource = VideoResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Tabs::make()
                    ->persistTabInQueryString()
                    ->tabs([
                        Tabs\Tab::make('details')
                            ->label(__('Details'))
                            ->schema([
                                ...GeneralForm::make(),
                            ]),

                        Tabs\Tab::make('assets')
                            ->label(__('Assets'))
                            ->schema([
                                ...MediaForm::make(),
                            ]),

                        Tabs\Tab::make('content')
                            ->label(__('Content'))
                            ->schema([
                                ...FeatureForm::make(),
                                ...ContentForm::make(),
                            ]),
                    ]),
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

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        app(UpdateVideoDetails::class)->execute($record, $data);

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            Actions\Action::make('regenerate')
                ->label(__('Regenerate'))
                ->icon('heroicon-o-document-check')
                ->action(fn (Model $record) => app(RegenerateVideo::class)->execute($record)),

            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\ForceDeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\RestoreAction::make()
                ->icon('heroicon-s-arrow-uturn-up'),
        ];
    }
}
