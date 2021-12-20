<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence\Elasticsearch;

use Shared\Domain\Criteria\Filter\Filter;
use Shared\Domain\Criteria\Filter\FilterOperator;

final class ElasticsearchCriteriaConverter
{
    private const RANGE_MAPPINGS = [
        FilterOperator::LT => 'lt'
    ];

    public static function transform(Filter $filter): array
    {
        return self::transformer($filter->operator())($filter);
    }

    private static function transformer(FilterOperator $operator): callable
    {
        return match ($operator->value()) {
            FilterOperator::EQ => self::eq(),
            FilterOperator::LT => self::range()
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

    private static function range(): callable
    {
        return fn(Filter $filter) => [
            "range" => [
                $filter->field()->value() => [
                    self::RANGE_MAPPINGS[$filter->operator()->value()] => $filter->value()->value()
                ]
            ]
        ];
    }
}
