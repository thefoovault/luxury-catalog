<?php

declare(strict_types=1);

namespace Test\Catalog\Application;

use Catalog\Application\ProductResponse;
use Catalog\Application\Search\ProductViewModel;

final class ProductResponseMother
{
    public static function create(
        string $sku,
        string $name,
        string $category,
        int $price
    ): ProductResponse
    {
        return new ProductResponse(
            $sku,
            $name,
            $category,
            $price
        );
    }

    public static function createFromReadModel(ProductViewModel $productViewModel): ProductResponse
    {
        return self::create(
            $productViewModel->sku(),
            $productViewModel->name(),
            $productViewModel->category(),
            $productViewModel->price()
        );
    }
}
