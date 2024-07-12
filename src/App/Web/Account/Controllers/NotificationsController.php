<?php

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

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.user.deleted" => '$refresh',
            "echo-private:user.{$id},.user.updated" => '$refresh',
        ];
    }
}
