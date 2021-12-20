<?php

declare(strict_types=1);

namespace Catalog\Infrastructure\Persistence;

use Catalog\Application\ProductReadModel;
use Catalog\Application\Search\ProductsViewModel;
use Catalog\Application\Search\ProductViewModel;
use Elasticsearch\Client;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filter\Filter;
use Shared\Domain\Criteria\Filter\Filters;
use Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchCriteriaConverter;

final class ElasticProductReadModel implements ProductReadModel
{
    private const INDEX = 'catalog-search';

    public function __construct(
        private Client $client
    ) {}

    public function search(Criteria $criteria): ProductsViewModel
    {
        $params = [
            'index' => self::INDEX,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => $this->transformFilters($criteria->filters())
                    ]
                ],
                'size' => $criteria->limit(),
                'from' => $criteria->offset() * $criteria->limit(),
            ]
        ];

        $response = $this->client->search($params);

        $productsView = [];

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

    public function transformFilters(Filters $filters): array
    {
        return array_values(
            array_map(
                fn(Filter $filter) => ElasticsearchCriteriaConverter::transform($filter),
                $filters->filters()
            )
        );
    }
}
