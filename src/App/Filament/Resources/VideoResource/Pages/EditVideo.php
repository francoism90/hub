<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Concerns\InteractsWithFormData;
use App\Filament\Resources\VideoResource;
use App\Filament\Resources\VideoResource\Actions\RegenerateAction;
use App\Filament\Resources\VideoResource\Forms\AssetForm;
use App\Filament\Resources\VideoResource\Forms\ContentForm;
use App\Filament\Resources\VideoResource\Forms\FeatureForm;
use App\Filament\Resources\VideoResource\Forms\GeneralForm;
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
                                ...AssetForm::make(),
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

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        app(UpdateVideoDetails::class)->execute($record, $data);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            RegenerateAction::make()
                ->color('gray'),

            Actions\ViewAction::make()
                ->label(__('View'))
                ->color('gray')
                ->icon('heroicon-o-eye')
                ->url(fn (Model $record) => route('videos.view', $record), true),

            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\ForceDeleteAction::make()
                ->icon('heroicon-o-trash'),

            Actions\RestoreAction::make()
                ->icon('heroicon-s-arrow-uturn-up'),
        ];
    }
}
