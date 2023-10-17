<?php

namespace App\Web\Search\Forms;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Form;

class SearchForm extends Form
{
    #[Rule('nullable|min:1|max:255')]
    public ?string $query = null;

    #[Rule('nullable|in:released,longest,shortest')]
    public ?string $sort = null;

    #[Rule('nullable|array|in:caption')]
    public ?array $feature = null;

    public function populate(): void
    {
        if (! session()->has('search')) {
            return;
        }

        $this->query = (string) session('search.query');

        $this->feature = (array) session('search.feature');

        $this->sort = (string) session('search.sort');
    }

    public function store(): void
    {
        session()->put('search', $this->all());
    }
}
