<?php

declare(strict_types=1);

namespace Domain\Users\Commands;

use Domain\Users\Actions\CreateNewUser;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

use function Laravel\Prompts\text;

class CreateUser extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * @var string
     */
    protected $description = 'Create a new user';

    public function handle(): void
    {
        $name = text(
            label: 'Name',
            required: true,
        );

        $email = text(
            label: 'Email',
            required: true,
        );

        $password = text(
            label: 'Password',
            required: true,
        );

        app(CreateNewUser::class)->execute(compact('name', 'email', 'password'));

        $this->info('User has been created successfully.');
    }
}
