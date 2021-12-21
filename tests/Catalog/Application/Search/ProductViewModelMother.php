<?php

declare(strict_types=1);

namespace Test\Catalog\Application\Search;

use Catalog\Application\Search\ProductViewModel;
use Faker\Factory;

final class ProductViewModelMother
{
    public static function create(
        string $sku,
        string $name,
        string $category,
        int $price
    ): ProductViewModel
    {
        return new ProductViewModel(
            $sku,
            $name,
            $category,
            $price
        );
    }

    public static function random(): ProductViewModel
    {
        return self::create(
            str_pad((string) Factory::create()->numberBetween(1,5), 6, '0'),
            Factory::create()->text(15),
            Factory::create()->text(15),
            Factory::create()->randomNumber(5)
        );
    }
}
