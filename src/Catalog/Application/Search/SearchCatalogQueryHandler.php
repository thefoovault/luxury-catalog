<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Catalog\Application\ProductsResponse;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Criteria\Filter\FilterOperator;
use Shared\Domain\Criteria\Filter\Filters;

final class SearchCatalogQueryHandler implements QueryHandler
{
    private const CATEGORY = 'category';

    private const VALID_FILTERS = [
        self::CATEGORY => [
            FilterOperator::EQ,
        ],
    ];

    public function __construct(
        private SearchCatalog $searchCatalog
    ) {}

    public function __invoke(SearchCatalogQuery $searchCatalogQuery): ProductsResponse
    {
        $filters = Filters::fromValues($searchCatalogQuery->filters(), self::VALID_FILTERS);
        $products = $this->searchCatalog->__invoke($filters);

        return ProductsResponse::fromProductsView($products);
    }
}
