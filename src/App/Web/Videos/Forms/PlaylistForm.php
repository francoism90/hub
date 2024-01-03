<?php

namespace App\Web\Videos\Forms;

use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;

class PlaylistForm extends Form
{
    use WithSearch;
    use WithSorts;

    protected static bool $recoverable = true;

    public function sorters(): array
    {
        return [
            '' => __('Date added (newest)'),
            'oldest' => __('Date added (oldest)'),
            'published' => __('Date published'),
        ];
    }
}
