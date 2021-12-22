<?php

declare(strict_types=1);

namespace Catalog\Application;

use Catalog\Application\Search\ProductViewModel;
use Shared\Domain\Bus\Query\QueryResponse;
use Shared\Domain\Discount\DiscountedPrice\DiscountedPrice;

final class ProductResponse implements QueryResponse
{
    public function __construct(
        private string $sku,
        private string $name,
        private string $category,
        private PriceResponse $price
    ) {}

    public static function fromProductViewModel(ProductViewModel $productViewModel, DiscountedPrice $discountedPrice): self
    {
        return new self(
            $productViewModel->sku(),
            $productViewModel->name(),
            $productViewModel->category(),
            PriceResponse::fromDiscountedPrice($discountedPrice)
        );
    }

    public function sku(): string
    {
        return $this->sku;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function price(): array
    {
        return $this->price;
    }
}
