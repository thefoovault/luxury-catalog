<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria\Filter;

use Shared\Domain\Criteria\Filter\Exception\InvalidOperator;

final class FilterOperator
{
    public const EQ = 'eq';

    private const VALID_OPERATORS = [
        self::EQ
    ];

    public function __construct(
        private string $value
    ) {
        if (!in_array($this->value, self::VALID_OPERATORS, true)) {
            throw new InvalidOperator($$this->value);
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
