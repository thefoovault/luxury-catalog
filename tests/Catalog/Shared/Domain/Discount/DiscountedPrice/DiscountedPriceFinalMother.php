<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Discount\DiscountedPrice;

use Faker\Factory;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceFinal;

final class DiscountedPriceFinalMother
{
    public static function create(int $final): DiscountedPriceFinal
    {
        return new DiscountedPriceFinal($final);
    }

    public static function random(): DiscountedPriceFinal
    {
        return self::create(Factory::create()->numberBetween(15, 600));
    }
}
