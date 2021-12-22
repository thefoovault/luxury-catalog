<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

use Shared\Domain\Aggregate\Collection;

final class DiscountStrategies extends Collection
{
    protected function type(): string
    {
        return DiscountStrategy::class;
    }
}
