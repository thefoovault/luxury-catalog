<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Criteria\Filter;

use Shared\Domain\Criteria\Filter\FilterField;

final class FilterFieldMother
{
    public static function create(
        string $filter
    ): FilterField
    {
        return new FilterField($filter);
    }
}
