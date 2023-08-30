<?php

namespace Domain\Shared\Concerns;

use Closure;

trait InteractsWithProgress
{
    public ?Closure $onProgressFn = null;

    public function onProgress(Closure $fn): self
    {
        $this->onProgressFn = $fn;

        return $this;
    }

    public function callOnProgressHook(...$args): void
    {
        if ($this->onProgressFn) {
            ($this->onProgressFn)(...$args);
        }
    }
}
