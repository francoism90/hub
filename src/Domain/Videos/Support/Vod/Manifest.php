<?php

namespace Domain\Videos\Support\Vod;

use Illuminate\Support\Fluent;

class Manifest extends Fluent
{
    public function id(string $value): self
    {
        $this->id = $value;

        return $this;
    }

    public function discontinuity(bool $value): self
    {
        $this->discontinuity = $value;

        return $this;
    }

    public function durations(array $value): self
    {
        $this->durations = $value;

        return $this;
    }

    public function referenceClipIndex(int $value): self
    {
        $this->referenceClipIndex = $value;

        return $this;
    }

    public function sequences(array $values): self
    {
        $this->sequences = $values;

        return $this;
    }
}
