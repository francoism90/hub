<?php

namespace App\Web\Auth\Controllers;

use App\Web\Auth\Forms\LoginForm;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class LoginController extends Page
{
    public LoginForm $form;

    public function boot(): void
    {
        if (static::isAuthenticated()) {
            $this->redirectIntended();
        }
    }

    public function render(): View
    {
        return view('auth.login');
    }

    public function submit(): void
    {
        $this->form->submit();
    }

    protected function getTitle(): ?string
    {
        return __('Log In');
    }

    protected function getDescription(): ?string
    {
        return __('Log in to your account');
    }
}
