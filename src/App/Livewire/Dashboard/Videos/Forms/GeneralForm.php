<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|array|min:1|max:50|exists:tags,prefixed_id')]
    public array $tags = [];

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

    protected function beforeFormFill(Video $model): mixed
    {
        $data = $model->only('name');

        $data['tags'] = $model->tags->routeKeys()->toArray();

        return $data;
    }
}
