<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;
use Shared\Domain\Discount\Product\Product;

interface DiscountStrategy
{
    public function execute(Product $product): DiscountedPrice;

    public function canApply(Product $product): bool;
}
