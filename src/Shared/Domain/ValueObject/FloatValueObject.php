<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class FloatValueObject
{
    public function __construct(
        protected float $value
    ){}

    public function value(): float
    {
        return $this->value;
    }

    public function multiply(self $number): self
    {
        return new static(
            $this->value() * $number->value()
        );
    }

    public function divide(self $number): self
    {
        return new static(
            $this->value() / $number->value()
        );
    }
}
