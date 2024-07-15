<?php

namespace App\Web\Account\Controllers;

use App\Web\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class NotificationsController extends Page
{
    use WithAuthentication;

    public function render(): View
    {
        return view('app.account.notifications');
    }

    protected function getTitle(): ?string
    {
        return __('Notifications');
    }

    protected function getDescription(): ?string
    {
        return __('Manage your notifications and preferences.');
    }

    public function getListeners(): array
    {
        return [
            ...$this->geAuthListeners(),
        ];
    }
}
