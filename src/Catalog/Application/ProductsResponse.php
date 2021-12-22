<?php

declare(strict_types=1);

namespace Catalog\Application;

use Shared\Domain\Aggregate\Collection;
use Shared\Domain\Bus\Query\QueryResponse;

final class ProductsResponse extends Collection implements QueryResponse
{
    protected function type(): string
    {
        return ProductResponse::class;
    }
}
