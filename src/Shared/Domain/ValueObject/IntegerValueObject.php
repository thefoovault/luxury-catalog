<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class IntegerValueObject
{
    public function __construct(
        protected int $value
    ) {}

    public function value(): int
    {
        return $this->value;
    }

    public function subtract(self $number): self
    {
        return new static(
            $this->value - $number->value()
        );
    }
}
