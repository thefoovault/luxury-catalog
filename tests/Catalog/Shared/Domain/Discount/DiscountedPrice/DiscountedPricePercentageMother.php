<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Discount\DiscountedPrice;

use Faker\Factory;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPricePercentage;

final class DiscountedPricePercentageMother
{
    public static function create(int $final): DiscountedPricePercentage
    {
        return new DiscountedPricePercentage($final);
    }

    public static function random(): DiscountedPricePercentage
    {
        return self::create(Factory::create()->numberBetween(0, 80));
    }
}
