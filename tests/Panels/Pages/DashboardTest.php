<?php

use App\Filament\Pages\Dashboard;
use Domain\Users\Models\User;

it('can render page', function () {
    $this->actingAs(User::factory()->verified()->create());

    $this->get(Dashboard::getUrl())
        ->assertSuccessful();
});
