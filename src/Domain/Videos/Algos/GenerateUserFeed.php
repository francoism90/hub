<?php

declare(strict_types=1);

namespace Domain\Videos\Algos;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class GenerateUserFeed extends Algo
{
    protected ?User $user = null;

    protected ?int $limit = null;

    protected ?int $lifetime = null;

    public function handle(): Result
    {
        $hash = $this->generateUniqueId();

        Video::modelClassCache(
            $hash,
            ['ids' => $this->getCollection()->toArray()],
            now()->addSeconds($this->getLifeTime()),
        );

        return $this
            ->success()
            ->with('hash', $hash);
    }

    public function model(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function lifetime(int $value): self
    {
        $this->lifetime = $value;

        return $this;
    }

    protected function getCollection(): LazyCollection
    {
        return Video::query()
            ->select('id')
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return $this->limit ?? 24;
    }

    protected function getLifeTime(): int
    {
        return $this->lifetime ?? 900;
    }

    protected function generateUniqueId(): string
    {
        return (string) Str::ulid();
    }
}
