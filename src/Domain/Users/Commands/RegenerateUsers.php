<?php

declare(strict_types=1);

namespace Domain\Users\Commands;

use Domain\Users\Actions\RegenerateUser;
use Domain\Users\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\LazyCollection;

class RegenerateUsers extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'users:regenerate';

    /**
     * @var string
     */
    protected $description = 'Regenerate user models';

    public function handle(): void
    {
        $this->getCollection()->each(
            fn (User $user) => app(RegenerateUser::class)->execute($user)
        );

        $this->components->info('User regenerating has been dispatched successfully.');
    }

    protected function getCollection(): LazyCollection
    {
        return User::query()->cursor();
    }
}
