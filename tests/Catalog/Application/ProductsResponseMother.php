<?php

declare(strict_types=1);

namespace Test\Catalog\Application;

use Catalog\Application\ProductsResponse;
use Catalog\Application\Search\ProductsViewModel;
use Catalog\Application\Search\ProductViewModel;

final class ProductsResponseMother
{
    public static function create(
        array $productsResponse
    ): ProductsResponse
    {
        return new ProductsResponse(
            $productsResponse
        );
    }

    public static function createFromReadModel(ProductsViewModel $productsViewModel): ProductsResponse
    {
        $productsResponse = [];

        /** @var ProductViewModel $productViewModel */
        foreach ($productsViewModel->getIterator() as $productViewModel) {
            $productsResponse[] = ProductResponseMother::createFromReadModel($productViewModel);
        }

        return self::create(
            $productsResponse
        );
    }
}
