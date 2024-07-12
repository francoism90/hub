<?php

namespace App\Web\Account\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class ProfileController extends Page
{
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
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.user.deleted" => '$refresh',
            "echo-private:user.{$id},.user.updated" => '$refresh',
        ];
    }
}
