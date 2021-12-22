<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceCurrency;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceFinal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceOriginal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPricePercentage;
use Shared\Domain\Discount\Product\Product;

final class NoPercentageStrategy implements DiscountStrategy
{
    public function execute(Product $product): DiscountedPrice
    {
        return new DiscountedPrice(
            new DiscountedPriceOriginal($product->price()->value()),
            new DiscountedPriceFinal($product->price()->value()),
            new DiscountedPricePercentage(0),
            DiscountedPriceCurrency::fromEuro()
        );
    }

    public function canApply(Product $product): bool
    {
        return true;
    }
}
