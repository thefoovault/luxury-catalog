<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony\Persistence\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

final class ElasticsearchClientFactory
{
    public function __construct(
        private string $host
    ) {}

    public function __invoke(): Client
    {
        return ClientBuilder::create()
            ->setHosts([$this->host])
            ->build();
    }
}
