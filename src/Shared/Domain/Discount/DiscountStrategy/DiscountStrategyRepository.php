<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

interface DiscountStrategyRepository
{
    public function discountStrategiesOrderedByPercentage(): DiscountStrategies;
}
