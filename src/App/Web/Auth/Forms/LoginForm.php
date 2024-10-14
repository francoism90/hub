<?php

declare(strict_types=1);

namespace App\Web\Auth\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;

class LoginForm extends Form
{
    protected static int $maxAttempts = 5;

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public bool $remember = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'remember' => 'nullable|boolean',
            'password' => [
                'required',
                Password::defaults(),
            ],
        ];
    }

    protected function handle(): void
    {
        if (! Auth::attempt($this->only('email', 'password'), $this->remember)) {
            flash()->error(__('These credentials do not match our records.'));

            return;
        }

        session()->regenerate();

        $this->redirect();
    }

    protected function redirect(): void
    {
        $this->getComponent()->redirectIntended();
    }
}
