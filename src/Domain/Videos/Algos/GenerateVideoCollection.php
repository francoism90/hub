<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use App\Api\Videos\Resources\VideoResource;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GenerateVideoCollection
{
    public function handle(User $user, int $limit = 16): ResourceCollection
    {
        return Video::query()
            ->inRandomOrder()
            ->take($limit)
            ->get()
            ->toResourceCollection(VideoResource::class);
    }
}
