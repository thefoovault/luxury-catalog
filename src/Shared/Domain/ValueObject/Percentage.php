<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\Exception\InvalidPercentage;

class Percentage extends FloatValueObject
{
    private const SYMBOL = '%';
    private const DECIMALS = 2;

    public function __construct(float $value)
    {
        $this->assertValidPercentage($value);
        parent::__construct((float) number_format($value, self::DECIMALS));
    }

    private function assertValidPercentage(float $value): void
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidPercentage($value);
        }
    }

    public function applyPercentage(IntegerValueObject $original): IntegerValueObject
    {
        $difference = $this->obtainPercentage(new FloatValueObject($original->value()));

        return $original->subtract($difference);
    }

    public function obtainPercentage(FloatValueObject $original): IntegerValueObject
    {
        $result = $original->multiply($this);
        $result = $result->divide(new FloatValueObject(100));

        return new IntegerValueObject((int) $result->value());
    }

    public function formatted(): string
    {
        return $this->value().self::SYMBOL;
    }
}
