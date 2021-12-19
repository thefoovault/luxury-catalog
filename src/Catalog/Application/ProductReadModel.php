<?php

declare(strict_types=1);

namespace Catalog\Application;

use Catalog\Application\Search\ProductsViewModel;

interface ProductReadModel
{
    public function search(): ProductsViewModel;
}
