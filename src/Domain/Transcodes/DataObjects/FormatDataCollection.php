<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 * @template TData of \Domain\Transcodes\DataObjects\FormatData
 *
 * @extends \Illuminate\Support\Collection<TKey, TData>
 */
class FormatDataCollection extends Collection
{
    //
}
