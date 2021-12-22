<?php

declare(strict_types=1);

namespace Test\Catalog\Application\Search;

use Catalog\Application\Search\SearchCatalogQuery;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filter\Filter;

final class SearchCatalogQueryMother
{
    public static function create(
        array $filters
    ): SearchCatalogQuery
    {
        return new SearchCatalogQuery(
            $filters
        );
    }

    public static function fromCriteria(Criteria $criteria): SearchCatalogQuery
    {
        $rawFilters = [];
        $criteriaFilters = $criteria->filters();

        /** @var Filter $criteriaFilter */
        foreach($criteriaFilters as $criteriaFilter) {
            $rawFilters[$criteriaFilter->field()->value()] = [
                $criteriaFilter->operator()->value() => $criteriaFilter->value()->value()
            ];
        }

        return self::create($rawFilters);
    }
}
