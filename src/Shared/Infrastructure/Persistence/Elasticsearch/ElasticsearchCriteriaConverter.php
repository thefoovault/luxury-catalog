<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence\Elasticsearch;

use Shared\Domain\Criteria\Filter\Filter;
use Shared\Domain\Criteria\Filter\FilterOperator;

final class ElasticsearchCriteriaConverter
{
    public static function transform(Filter $filter): array
    {
        return self::transformer($filter->operator())($filter);
    }

    private static function transformer(FilterOperator $operator): callable
    {
        return match ($operator->value()) {
            FilterOperator::EQ => self::eq()
        };
    }

    private static function eq(): callable
    {
        return fn(Filter $filter) => [
            "term" => [
                $filter->field()->value() => $filter->value()->value()
            ]
        ];
    }
}
