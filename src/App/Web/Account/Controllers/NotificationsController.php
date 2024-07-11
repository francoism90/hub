<?php

namespace App\Web\Account\Controllers;

use App\Web\Library\Forms\QueryForm;
use App\Web\Library\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

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
