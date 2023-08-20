<?php

namespace App\Admin\Resources\VideoResource\Pages;

use App\Admin\Resources\VideoResource;
use Domain\Videos\Actions\GetImportableVideos;
use Filament\Actions\Action;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Symfony\Component\Finder\SplFileInfo;

class ImportVideos extends Page implements HasForms, HasActions
{
    use Translatable;
    use InteractsWithFormActions;
    use HasWizard;

    protected static string $resource = VideoResource::class;

    protected static string $view = 'filament-panels::resources.pages.create-record';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->authorizeAccess();
    }

    protected function authorizeAccess(): void
    {
        static::authorizeResourceAccess();

        abort_unless(static::getResource()::canCreate(), 403);
    }

    public function create(): void
    {
        $this->authorizeAccess();

        try {
            $data = $this->form->getState();

            // TODO: add action
            dd($data);

            $this->getCreatedNotification()?->send();
        } catch (Halt $exception) {
            return;
        }

        $this->redirect($this->getRedirectUrl());
    }

    protected function getSteps(): array
    {
        return [
            Components\Wizard\Step::make('media')
                ->label(__('Media'))
                ->description(__('Customize the media you want to import'))
                ->schema([
                    Components\Repeater::make('media')
                        ->addable(false)
                        ->reorderableWithButtons()
                        ->required()
                        ->minItems(1)
                        ->grid(2)
                        ->hintAction($this->getScanFormAction())
                        ->schema([
                            Components\TextInput::make('name')
                                ->label(__('File Name'))
                                ->required()
                                ->maxLength(255),

                            Components\TextInput::make('path')
                                ->label(__('File Location'))
                                ->required()
                                ->readOnly(),

                            Components\Placeholder::make('file_size')
                                ->label(__('File Size'))
                                ->content(fn (Get $get): ?string => human_filesize($get('size'))),
                        ]),
                ]),

            Components\Wizard\Step::make('summary')
                ->label(__('Summary'))
                ->description(__('Start the import process'))
                ->schema([
                    Components\Placeholder::make('count')
                        ->label(__('Total Files'))
                        ->content(fn (Get $get): ?string => count(
                            $get('media') ?? []
                        )),

                    Components\Placeholder::make('amount')
                        ->label(__('Total File Size'))
                        ->content(fn (Get $get): ?string => human_filesize(
                            array_sum($get('media.*.size') ?? [])
                        )),
                ]),
        ];
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [];
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__('Import'))
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getSubmitFormAction(): Action
    {
        return $this->getCreateFormAction();
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
            ->url($this->previousUrl ?? static::getResource()::getUrl())
            ->color('gray');
    }

    protected function getScanFormAction(): Components\Actions\Action
    {
        return Components\Actions\Action::make('scan')
            ->label('Scan')
            ->icon('heroicon-o-archive-box')
            ->action(fn (Set $set) => $set('media', $this->prepareForImport()));
    }

    protected function getRedirectUrl(): string
    {
        $resource = static::getResource();

        return $resource::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Import process has been started.'));
    }

    protected function prepareForImport(): array
    {
        $files = app(GetImportableVideos::class)->execute();

        return collect($files)
            ->map(fn (SplFileInfo $file) => [
                'name' => $file->getFilenameWithoutExtension(),
                'path' => $file->getRelativePathname(),
                'size' => $file->getSize(),
            ])
            ->keyBy('name')
            ->toArray();
    }

    public function getBreadcrumb(): string
    {
        return __('Import');
    }

    public function getFormStatePath(): ?string
    {
        return 'data';
    }
}
