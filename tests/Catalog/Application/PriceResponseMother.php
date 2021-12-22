<?php

declare(strict_types=1);

namespace Test\Catalog\Application;

use Catalog\Application\PriceResponse;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;

final class PriceResponseMother
{
    public static function create(
        int $original,
        int $final,
        string $discountPercentage,
        string $currency
    ): PriceResponse
    {
        return new PriceResponse(
            $original,
            $final,
            $discountPercentage,
            $currency
        );
    }

    public static function createFromDiscountedPrice(DiscountedPrice $discountedPrice): PriceResponse
    {
        return PriceResponse::fromDiscountedPrice($discountedPrice);
    }

}
