<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountedPrice;

final class DiscountedPrice
{
    public function __construct(
        private DiscountedPriceOriginal $original,
        private DiscountedPriceFinal $final,
        private DiscountedPricePercentage $percentage,
        private DiscountedPriceCurrency $currency
    ) {}

    public function original(): DiscountedPriceOriginal
    {
        return $this->original;
    }

    public function final(): DiscountedPriceFinal
    {
        return $this->final;
    }

    public function percentage(): DiscountedPricePercentage
    {
        return $this->percentage;
    }

    public function currency(): DiscountedPriceCurrency
    {
        return $this->currency;
    }
}
