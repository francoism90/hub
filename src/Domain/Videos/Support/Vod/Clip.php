<?php

namespace Domain\Videos\Support\Vod;

use Illuminate\Support\Fluent;

class Clip extends Fluent
{
    public function type(?string $value): self
    {
        $this->type = $value;

        return $this;
    }

    public function sourceType(string $value): self
    {
        $this->sourceType = $value;

        return $this;
    }

    public function path(string $value): self
    {
        $this->path = $value;

        return $this;
    }

    public function clipFrom(int $value): self
    {
        $this->clipFrom = $value;

        return $this;
    }
}
