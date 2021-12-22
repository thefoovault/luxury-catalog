<?php

declare(strict_types=1);

namespace Shared\Application\GetDiscountStrategies;

use Shared\Domain\Discount\DiscountStrategy\DiscountStrategies;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategyRepository;

final class GetDiscountStrategies
{
    public function __construct(
        private DiscountStrategyRepository $discountStrategyRepository
    ) {}

    public function __invoke(): DiscountStrategies
    {
        return $this->discountStrategyRepository->discountStrategiesOrderedByPercentage();
    }
}
