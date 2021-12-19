<?php

declare(strict_types=1);

namespace Catalog\Infrastructure\Persistence;

use Catalog\Application\ProductReadModel;
use Catalog\Application\Search\ProductsViewModel;
use Catalog\Application\Search\ProductViewModel;
use Elasticsearch\Client;

final class ElasticProductReadModel implements ProductReadModel
{
    private const INDEX = 'catalog-search';

    public function __construct(
        private Client $client
    ) {}

    public function search(): ProductsViewModel
    {
        $productsView = [];

        $response = $this->client->search(
            [
                'index' => self::INDEX,
            ]
        );

        foreach ($response['hits']['hits'] as $hit) {
            $product = $hit['_source'];
            $productsView[] = new ProductViewModel(
                $product['sku'],
                $product['name'],
                $product['category'],
                $product['price']
            );
        }

        return new ProductsViewModel($productsView);
    }
}
