<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use App\Livewire\Forms\Concerns\WithTags;
use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\UpdateForm;
use Livewire\Attributes\Validate;

class GeneralForm extends UpdateForm
{
    use WithTags;

    #[Validate('required|string|max:255')]
    public string $name = '';

    public function populate(Video $model): void
    {
        $this->setModel($model);

        $this->fillModelAttributes('name');

        $this->fillModelTags($model);
    }

    protected function handle(): void
    {
        $validated = $this->validate();

        dd($validated);

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
