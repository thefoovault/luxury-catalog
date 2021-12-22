<?php

declare(strict_types=1);

namespace Test\Catalog\Application\Search;

use Catalog\Application\Search\ProductsViewModel;
use Faker\Factory;

final class ProductsViewModelMother
{
    public static function create(
        array $productsViewModel
    ): ProductsViewModel
    {
        return new ProductsViewModel(
            $productsViewModel
        );
    }

    public static function random(): ProductsViewModel
    {
        $productsViewModel = [];
        $numberProducts = Factory::create()->numberBetween(1, 5);

        for ($i = 0; $i < $numberProducts; $i ++) {
            $productsViewModel[] = ProductViewModelMother::random();
        }

        return self::create(
            $productsViewModel
        );
    }
}
