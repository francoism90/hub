<?php

namespace Domain\Videos\Support\Vod;

use Illuminate\Support\Fluent;

class Sequence extends Fluent
{
    public function clips(array $values): self
    {
        $this->clips = collect($values)
            ->reject(fn (mixed $item) => ! $item instanceof Clip)
            ->map(fn (Clip $item) => $item->toArray())
            ->all();

        return $this;
    }

    public function id(string $value): self
    {
        $this->id = $value;

        return $this;
    }

    public function language(string $value): self
    {
        $this->language = $value;

        return $this;
    }

    public function label(string $value): self
    {
        $this->label = $value;

        return $this;
    }

    public function bitrate(array $value): self
    {
        $this->bitrate = $value;

        return $this;
    }

    public function avgBitrate(array $value): self
    {
        $this->avg_bitrate = $value;

        return $this;
    }
}
