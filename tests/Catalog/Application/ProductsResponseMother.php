<?php

declare(strict_types=1);

namespace Test\Catalog\Application;

use Catalog\Application\ProductsResponse;
use Catalog\Application\Search\ProductsViewModel;
use Catalog\Application\Search\ProductViewModel;
use Shared\Domain\Discount\DiscountCalculatorService;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategies;
use Shared\Domain\Discount\Product\Product;
use Shared\Domain\Discount\Product\ProductCategory;
use Shared\Domain\Discount\Product\ProductName;
use Shared\Domain\Discount\Product\ProductPrice;
use Shared\Domain\Discount\Product\ProductSku;

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

    public static function createFromReadModel(
        ProductsViewModel $productsViewModel,
        DiscountStrategies $discountStrategies,
        DiscountCalculatorService $discountCalculatorService
    ): ProductsResponse
    {
        $productsResponse = [];

        /** @var ProductViewModel $productViewModel */
        foreach ($productsViewModel as $productViewModel) {
            $productsResponse[] = ProductResponseMother::createFromReadModel(
                $productViewModel,
                $discountCalculatorService->applyDiscount(
                    new Product(
                        new ProductSku($productViewModel->sku()),
                        new ProductName($productViewModel->name()),
                        new ProductCategory($productViewModel->category()),
                        new ProductPrice($productViewModel->price())
                    ),
                    $discountStrategies
                )
            );
        }

        return self::create(
            $productsResponse
        );
    }
}
