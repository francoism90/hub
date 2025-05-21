<?php

declare(strict_types=1);

namespace Domain\Videos\Algos;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Illuminate\Support\LazyCollection;

class GenerateVideoSuggestions extends Algo
{
    public function __construct(
        protected ?Video $video = null,
        protected ?int $limit = null,
    ) {}

    public function handle(): Result
    {
        $items = collect([
            ...$this->phrases(),
            ...$this->tagged(),
            ...$this->random(),
        ]);

        return $this
            ->success()
            ->with('items', $items);
    }

    public function model(Video $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function limit(int $value): static
    {
        $this->limit = $value;

        return $this;
    }

    protected function phrases(): LazyCollection
    {
        $query = str($this->video->name)
            ->title()
            ->matchAll('/[\p{L}\p{N}]+/u')
            ->reject(fn (string $word) => in_array(mb_strtolower($word), ['and', 'a', 'or']))
            ->take(6)
            ->merge([$this->video->identifier])
            ->filter()
            ->unique();

        $items = LazyCollection::make(function () use ($query) {
            // e.g. foo bar 1, foo bar, foo
            for ($i = $query->count(); $i >= 1; $i--) {
                $phrase = (string) $query->take($i)->implode(' ');

                yield Video::search($phrase)
                    ->where('state', Verified::$name)
                    ->take(7)
                    ->cursor();
            }
        });

        return $items
            ->flatten()
            ->reject(fn (Video $item) => $item->is($this->video))
            ->take(16)
            ->unique();
    }

    protected function tagged(): LazyCollection
    {
        $relatables = $this->video->tags
            ->loadMissing('relatables')
            ->flatMap(fn (Tag $tag) => $tag->related)
            ->unique()
            ->all();

        return Video::query()
            ->published()
            ->withAnyTagsOfAnyType([
                ...$this->video->tags,
                ...$relatables,
            ])
            ->whereKeyNot($this->video)
            ->inRandomOrder()
            ->take(16)
            ->cursor();
    }

    protected function random(): LazyCollection
    {
        return Video::query()
            ->published()
            ->whereKeyNot($this->video)
            ->inRandomOrder()
            ->take(16)
            ->cursor();
    }
}
