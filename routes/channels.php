<?php

declare(strict_types=1);

use Foundation\Broadcasting\GroupChannel;
use Foundation\Broadcasting\TagChannel;
use Foundation\Broadcasting\UserChannel;
use Foundation\Broadcasting\VideoChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{user}', UserChannel::class);
Broadcast::channel('group.{group}', GroupChannel::class);
Broadcast::channel('tag.{tag}', TagChannel::class);
Broadcast::channel('video.{video}', VideoChannel::class);
