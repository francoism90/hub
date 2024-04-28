<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\UpdateForm;
use Livewire\Attributes\Validate;

class GeneralForm extends UpdateForm
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    public function populate(Video $model): void
    {
        $this->setModel($model);

        $this->fillModelAttributes('name');
    }

    protected function handle(): void
    {
        $validated = $this->validate();

        // app(UpdateVideoDetails::class)->execute(
        //     $this->model,
        //     $validated,
        // );
    }

    protected function afterHandle(): void
    {
        flash()->success(__('Video has been updated!'));
    }
}
