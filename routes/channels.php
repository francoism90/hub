<?php

use Foundation\Broadcasting\PlaylistChannel;
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
Broadcast::channel('playlist.{playlist}', PlaylistChannel::class);
Broadcast::channel('tag.{tag}', TagChannel::class);
Broadcast::channel('video.{video}', VideoChannel::class);
