<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Discount\DiscountedPrice;

use Faker\Factory;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceOriginal;

final class DiscountedPriceOriginalMother
{
    public static function create(int $final): DiscountedPriceOriginal
    {
        return new DiscountedPriceOriginal($final);
    }

    public static function random(): DiscountedPriceOriginal
    {
        return self::create(Factory::create()->numberBetween(15, 600));
    }
}
