<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\Product;

final class Product
{
    public function __construct(
        private ProductSku $sku,
        private ProductName $name,
        private ProductCategory $category,
        private ProductPrice $price
    ) {}

    public function sku(): ProductSku
    {
        return $this->sku;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function category(): ProductCategory
    {
        return $this->category;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }
}
