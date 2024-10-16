<?php

declare(strict_types=1);

namespace App\Web\Account\Controllers;

use App\Web\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class SavedController extends Page
{
    use WithAuthentication;

    public function render(): View
    {
        return view('app.account.subscribe');
    }

    protected function getTitle(): ?string
    {
        return __('Choose your plan');
    }

    protected function getDescription(): ?string
    {
        return __("Choose a subscription plan that's right for you.");
    }

    public function getListeners(): array
    {
        return [
            ...$this->getAuthListeners(),
        ];
    }
}
