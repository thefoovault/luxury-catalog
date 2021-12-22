<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

final class InvalidPercentage extends DomainError
{
    public function __construct(
        private float $percentage
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid-percentage';
    }

    public function errorMessage(): string
    {
        return sprintf(
            'Percentage <%s> is invalid',
            $this->percentage
        );
    }
}
