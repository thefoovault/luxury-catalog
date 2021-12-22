<?php

declare(strict_types=1);

namespace Shared\Domain\Discount;

use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategies;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategy;
use Shared\Domain\Discount\DiscountStrategy\NoPercentageStrategy;
use Shared\Domain\Discount\Product\Product;

final class DiscountCalculatorService
{
    public function applyDiscount(Product $product, DiscountStrategies $discountStrategies): DiscountedPrice
    {
        $selectedStrategy = $this->selectDiscountStrategy($product, $discountStrategies);

        return $selectedStrategy->execute($product);
    }

    private function selectDiscountStrategy(Product $product, DiscountStrategies $discountStrategies): DiscountStrategy
    {
        /** @var DiscountStrategy $discountStrategy */
        foreach ($discountStrategies as $discountStrategy) {
            if ($discountStrategy->canApply($product)) {
                return $discountStrategy;
            }
        }

        return new NoPercentageStrategy();
    }
}
