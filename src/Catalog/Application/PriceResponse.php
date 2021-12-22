<?php

declare(strict_types=1);

namespace Catalog\Application;

use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;

final class PriceResponse
{
    public function __construct(
        private int $original,
        private int $final,
        private string $discountPercentage,
        private string $currency
    ) {}

    public static function fromDiscountedPrice(DiscountedPrice $discountedPrice): self
    {
        return new self(
            $discountedPrice->original()->value(),
            $discountedPrice->final()->value(),
            $discountedPrice->percentage()->formatted(),
            $discountedPrice->currency()->value()
        );
    }

    public function original(): int
    {
        return $this->original;
    }

    public function final(): int
    {
        return $this->final;
    }

    public function discountPercentage(): int
    {
        return $this->discountPercentage;
    }

    public function currency(): int
    {
        return $this->currency;
    }
}
