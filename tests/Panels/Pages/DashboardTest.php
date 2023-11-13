<?php

use Domain\Users\Models\User;
use Filament\Pages\Dashboard;

it('can render page', function () {
    $this->actingAs(User::factory()->create());

    $this->get(Dashboard::getUrl())
        ->assertSuccessful();
});
