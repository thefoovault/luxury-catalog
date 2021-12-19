<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Catalog\Application\ProductsResponse;
use Shared\Domain\Bus\Query\QueryHandler;

final class SearchCatalogQueryHandler implements QueryHandler
{
    public function __construct(
        private SearchCatalog $searchCatalog
    ) {}

    public function __invoke(SearchCatalogQuery $searchCatalogQuery): ProductsResponse
    {
        $products = $this->searchCatalog->__invoke();

        return new ProductsResponse();
    }
}
