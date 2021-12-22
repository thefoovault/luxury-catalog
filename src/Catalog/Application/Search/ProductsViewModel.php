<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Shared\Domain\Aggregate\Collection;

final class ProductsViewModel extends Collection
{
    protected function type(): string
    {
        return ProductViewModel::class;
    }
}
