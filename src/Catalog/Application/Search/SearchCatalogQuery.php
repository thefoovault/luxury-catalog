<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Shared\Domain\Bus\Query\Query;

final class SearchCatalogQuery implements Query
{
    public function __construct(
        private array $filters
    ) {}

    public function filters(): array
    {
        return $this->filters;
    }
}
