<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria\Filter\Exception;

use Shared\Domain\Exception\DomainError;

final class InvalidOperator extends DomainError
{
    public function __construct(
        private string $operator
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid-operator';
    }

    public function errorMessage(): string
    {
        return sprintf('The operator <%s> is invalid.', $this->operator);
    }
}
