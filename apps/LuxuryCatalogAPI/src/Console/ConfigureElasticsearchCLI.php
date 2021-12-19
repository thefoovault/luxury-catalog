<?php

declare(strict_types=1);

namespace LuxuryCatalogAPI\Console;

use Elasticsearch\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConfigureElasticsearchCLI extends Command
{
    protected static $defaultName = 'elasticsearch:prepare';

    private const INDEX = 'catalog-search';
    private const DATA_FILE = 'luxury_catalog-data.json';
    private const FILTER_SKU = 'sku';
    private const FILTER_NAME = 'name';
    private const FILTER_CATEGORY = 'category';
    private const FILTER_PRICE = 'price';

    private array $catalog;

    public function __construct(private Client $client)
    {
        $this->catalog = json_decode(file_get_contents(__DIR__ . '/' . self::DATA_FILE), true);
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->client->indices()->delete([
                'index' => self::INDEX
            ]);
        } catch (\Throwable) {}

        $output->writeln(sprintf(
            "Creating index <%s>",
            self::INDEX
        ));
        $this->client->indices()->create(
            [
                'index' => self::INDEX,
                'body'  => [
                    'settings' => [
                        'number_of_shards' => 2,
                        'number_of_replicas' => 0
                    ],
                    'mappings' =>[
                        'properties' => [
                            self::FILTER_SKU => [
                                'type' => 'keyword'
                            ],
                            self::FILTER_NAME => [
                                'type' => 'keyword'
                            ],
                            self::FILTER_CATEGORY => [
                                'type' => 'keyword'
                            ],
                            self::FILTER_PRICE => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ]
        );

        foreach ($this->catalog['products'] as $product) {
            $output->writeln(sprintf(
                "Adding data <%s>",
                $product['sku']
            ));
            $this->client->index(
                [
                    'index' => self::INDEX,
                    'id'    => $product['sku'],
                    'body'  => [
                        self::FILTER_SKU => $product['sku'],
                        self::FILTER_NAME => $product['name'],
                        self::FILTER_CATEGORY => $product['category'],
                        self::FILTER_PRICE => $product['price']
                    ]
                ]
            );
        }

        return self::SUCCESS;
    }
}
