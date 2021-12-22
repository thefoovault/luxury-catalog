<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceCurrency;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceFinal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceOriginal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPricePercentage;
use Shared\Domain\Discount\Product\Product;
use Shared\Domain\Discount\Product\ProductCategory;
use Shared\Domain\ValueObject\Percentage;

final class CategoryPercentageStrategy implements DiscountStrategy
{
    public function __construct(
        private ProductCategory $category,
        private Percentage $percentage
    ) {}

    public function execute(Product $product): DiscountedPrice
    {
        $appliedPercentage = $this->percentage->applyPercentage($product->price());

        return new DiscountedPrice(
            new DiscountedPriceOriginal($product->price()->value()),
            new DiscountedPriceFinal($appliedPercentage->value()),
            new DiscountedPricePercentage($this->percentage->value()),
            DiscountedPriceCurrency::fromEuro()
        );
    }

    public function canApply(Product $product): bool
    {
        return $this->category->equals($product->category());
    }
}
