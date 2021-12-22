<?php

declare(strict_types=1);

namespace Test\Catalog\Application;

use Catalog\Application\PriceResponse;
use Catalog\Application\ProductResponse;
use Catalog\Application\Search\ProductViewModel;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;

final class ProductResponseMother
{
    public static function create(
        string $sku,
        string $name,
        string $category,
        PriceResponse $price
    ): ProductResponse
    {
        return new ProductResponse(
            $sku,
            $name,
            $category,
            $price
        );
    }

    public static function createFromReadModel(ProductViewModel $productViewModel, DiscountedPrice $discountedPrice): ProductResponse
    {
        return self::create(
            $productViewModel->sku(),
            $productViewModel->name(),
            $productViewModel->category(),
            PriceResponseMother::createFromDiscountedPrice($discountedPrice)
        );
    }
}
