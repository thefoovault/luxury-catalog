<?php

declare(strict_types=1);

namespace Catalog\Application;

use Catalog\Application\Search\ProductsViewModel;
use Shared\Domain\Criteria\Criteria;

interface ProductReadModel
{
    public function search(Criteria $criteria): ProductsViewModel;
}
