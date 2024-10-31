<?php

declare(strict_types=1);

namespace App\Web\Account\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class NotificationsController extends Page
{
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
}
