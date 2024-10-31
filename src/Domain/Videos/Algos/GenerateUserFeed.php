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

    public function handle(): Result
    {
        return $this
            ->success()
            ->with('ids', $this->getVideoIds());
    }

    public function model(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function limit(int $value): self
    {
        $this->limit = $value;

        return $this;
    }

    protected function getVideoIds(): LazyCollection
    {
        return Video::query()
            ->select('id')
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor()
            ->pluck('id');
    }

    protected function getLimit(): int
    {
        return $this->limit ?? 16;
    }

    protected function generateUniqueId(): string
    {
        return (string) Str::ulid();
    }
}
