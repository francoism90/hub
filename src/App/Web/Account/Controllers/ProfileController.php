<?php

namespace App\Web\Account\Controllers;

use App\Web\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class ProfileController extends Page
{
    use WithAuthentication;

    public function render(): View
    {
        return view('app.account.profile');
    }

    protected function getTitle(): ?string
    {
        return __('Profile');
    }

    protected function getDescription(): ?string
    {
        return __('Manage your account settings and preferences.');
    }

    public function getListeners(): array
    {
        return [
            ...$this->geAuthListeners(),
        ];
    }
}
