<?php

namespace App\Web\Auth\Controllers;

use App\Web\Auth\Forms\LoginForm;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class LogoutController extends Page
{
    public LoginForm $form;

    public function boot(): void
    {
        if (! static::isAuthenticated()) {
            $this->redirectRoute('home');
        }
    }

    public function mount(): void
    {
        $this->submit();
    }

    public function render(): View
    {
        return view('auth.logout');
    }

    public function submit(): void
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        $this->redirectRoute('home');
    }

    protected function getTitle(): ?string
    {
        return __('Log out');
    }

    protected function getDescription(): ?string
    {
        return __('Log out of your account');
    }
}
