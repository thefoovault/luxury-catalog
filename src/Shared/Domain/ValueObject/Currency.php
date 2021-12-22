<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class Currency extends StringValueObject
{
    private const EURO = 'EUR';

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function fromEuro(): static
    {
        return new static(self::EURO);
    }
}
