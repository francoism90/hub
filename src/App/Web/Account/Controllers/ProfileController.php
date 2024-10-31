<?php

declare(strict_types=1);

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
}
