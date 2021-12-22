<?php

declare(strict_types=1);

namespace Shared\Domain\Discount\DiscountStrategy;

use Shared\Domain\Exception\DomainError;

final class InvalidDiscountStrategy extends DomainError
{
    public function __construct(
        private string $strategy
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid-discount-strategy';
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The <%s> is not a valid discount strategy',
            $this->strategy
        );
    }
}
