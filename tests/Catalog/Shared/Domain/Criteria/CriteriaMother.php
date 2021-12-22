<?php

declare(strict_types=1);

namespace Test\Catalog\Shared\Domain\Criteria;

use Faker\Factory;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filter\Filters;
use Test\Catalog\Shared\Domain\Criteria\Filter\FiltersMother;

final class CriteriaMother
{
    public static function create(
        Filters $filters
    ): Criteria
    {
        return new Criteria($filters);
    }

    public static function withFieldAndOperator(string $field, string $operator): Criteria
    {
        return self::create(
            FiltersMother::withFieldAndOperator($field, $operator)
        );
    }
}
