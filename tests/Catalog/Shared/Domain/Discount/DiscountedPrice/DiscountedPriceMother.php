<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Discount\DiscountedPrice;

use Catalog\Application\Search\ProductViewModel;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceCurrency;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceFinal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPriceOriginal;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPricePercentage;

final class DiscountedPriceMother
{
    public static function create(
        DiscountedPriceOriginal $original,
        DiscountedPriceFinal $final,
        DiscountedPricePercentage $percentage,
        DiscountedPriceCurrency $currency
    ): DiscountedPrice
    {
        return new DiscountedPrice(
            $original,
            $final,
            $percentage,
            $currency
        );
    }

    public static function random(): DiscountedPrice
    {
        return self::create(
            DiscountedPriceOriginalMother::random(),
            DiscountedPriceFinalMother::random(),
            DiscountedPricePercentageMother::random(),
            DiscountedPriceCurrency::fromEuro()
        );
    }

    public static function fromProductViewModel(ProductViewModel $productViewModel): DiscountedPrice
    {
        return self::create(

        );
    }
}
