<?php

declare(strict_types=1);

namespace Catalog\Application;

use Catalog\Application\Search\ProductViewModel;
use Shared\Domain\Bus\Query\QueryResponse;

final class ProductResponse implements QueryResponse
{
    public function __construct(
        private string $sku,
        private string $name,
        private string $category,
        private int $price
    ) {}

    public static function fromProductViewModel(ProductViewModel $productViewModel): self
    {
        return new self(
            $productViewModel->sku(),
            $productViewModel->name(),
            $productViewModel->category(),
            $productViewModel->price()
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

    public function price(): int
    {
        return $this->price;
    }
}