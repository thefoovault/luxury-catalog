<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Catalog\Application\ProductReadModel;

final class SearchCatalog
{
    public function __construct(
        private ProductReadModel $productReadModel
    ) {}

    public function __invoke(): ProductsViewModel
    {
        return $this->productReadModel->search();
    }
}
