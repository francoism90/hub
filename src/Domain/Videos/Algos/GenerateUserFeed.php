<?php

declare(strict_types=1);

namespace Domain\Videos\Algos;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\LazyCollection;

class GenerateUserFeed extends Algo
{
    public function __construct(
        protected ?QueryForm $form = null,
        protected ?User $user = null,
        protected ?int $limit = null,
    ) {}

    public function handle(): Result
    {
        return $this
            ->success()
            ->with('ids', $this->getVideoIds());
    }

    public function form(Form $form): static
    {
        $this->form = $form;

        return $this;
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
        return Video::query()->tap(
            new FilterVideos($this->form, $this->user, $this->getLimit())
        )->select('id')->cursor()->pluck('id');
    }

    protected function getLimit(): int
    {
        return $this->limit ?? 16;
    }
}
