<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Catalog\Application\ProductReadModel;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filter\Filters;

final class SearchCatalog
{
    public function __construct(
        private ProductReadModel $productReadModel
    ) {}

    public function __invoke(Filters $filters): ProductsViewModel
    {
        $criteria = new Criteria($filters);

        return $this->productReadModel->search($criteria);
    }
}
