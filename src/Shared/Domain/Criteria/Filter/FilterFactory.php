<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria\Filter;

final class FilterFactory
{
    private const TYPE_STRING = 'string';

    public static function create(
        FilterField $field,
        FilterOperator $operator,
        $value
    ): Filter
    {
        return match ($field->value()) {
            self::TYPE_STRING => new FilterString($field, $operator, $value)
        };
    }
}
