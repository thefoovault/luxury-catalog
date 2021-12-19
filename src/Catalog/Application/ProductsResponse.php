<?php

declare(strict_types=1);

namespace Catalog\Application;

use Catalog\Application\Search\ProductsViewModel;
use Shared\Domain\Aggregate\Collection;
use Shared\Domain\Bus\Query\QueryResponse;

final class ProductsResponse extends Collection implements QueryResponse
{
    protected function type(): string
    {
        return ProductResponse::class;
    }

    public static function fromProductsView(ProductsViewModel $productsViewModel): self
    {
        $products = [];

        foreach ($productsViewModel->getIterator() as $productViewModel) {
            $products[] = ProductResponse::fromProductViewModel($productViewModel);
        }

        return new self($products);
    }
}
