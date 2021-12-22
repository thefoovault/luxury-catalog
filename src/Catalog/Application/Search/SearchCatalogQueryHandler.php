<?php

declare(strict_types=1);

namespace Catalog\Application\Search;

use Catalog\Application\ProductResponse;
use Catalog\Application\ProductsResponse;
use Shared\Application\GetDiscountStrategies\GetDiscountStrategies;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Criteria\Filter\FilterOperator;
use Shared\Domain\Criteria\Filter\Filters;
use Shared\Domain\Discount\DiscountCalculatorService;
use Shared\Domain\Discount\Product\Product;
use Shared\Domain\Discount\Product\ProductCategory;
use Shared\Domain\Discount\Product\ProductName;
use Shared\Domain\Discount\Product\ProductPrice;
use Shared\Domain\Discount\Product\ProductSku;

final class SearchCatalogQueryHandler implements QueryHandler
{
    private const CATEGORY = 'category';
    private const PRICE = 'price';

    private const VALID_FILTERS = [
        self::CATEGORY => [
            FilterOperator::EQ,
        ],
        self::PRICE => [
            FilterOperator::LT,
        ],
    ];

    public function __construct(
        private SearchCatalog $searchCatalog,
        private GetDiscountStrategies $getDiscountStrategies,
        private DiscountCalculatorService $discountCalculatorService
    ) {}

    public function __invoke(SearchCatalogQuery $searchCatalogQuery): ProductsResponse
    {
        $filters = Filters::fromValues($searchCatalogQuery->filters(), self::VALID_FILTERS);
        $products = $this->searchCatalog->__invoke($filters);

        $discountStrategies = $this->getDiscountStrategies->__invoke();

        $response = new ProductsResponse([]);

        /** @var ProductViewModel $product */
        foreach ($products as $product) {
            $response->add(
                ProductResponse::fromProductViewModel(
                    $product,
                    $this->discountCalculatorService->applyDiscount(
                        new Product(
                            new ProductSku($product->sku()),
                            new ProductName($product->name()),
                            new ProductCategory($product->category()),
                            new ProductPrice($product->price())
                        ),
                        $discountStrategies
                    )
                )
            );

        }

        return $response;
    }
}
