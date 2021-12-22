<?php

declare(strict_types=1);

namespace Test\Catalog\Application\Search;

use Catalog\Application\ProductReadModel;
use Catalog\Application\Search\SearchCatalog;
use Catalog\Application\Search\SearchCatalogQueryHandler;
use PHPUnit\Framework\TestCase;
use Shared\Application\GetDiscountStrategies\GetDiscountStrategies;
use Shared\Domain\Criteria\Filter\Exception\InvalidFilter;
use Shared\Domain\Discount\DiscountCalculatorService;
use Shared\Infrastructure\Persistence\InMemoryDiscountStrategyRepository;
use Test\Catalog\Application\ProductsResponseMother;
use Test\Catalog\Shared\Domain\Criteria\CriteriaMother;
use Test\Catalog\Shared\Domain\Discount\DiscountedPrice\DiscountedPriceMother;

final class SearchCatalogQueryHandlerTest extends TestCase
{
    private ProductReadModel $productReadModel;
    private SearchCatalogQueryHandler $searchCatalogQueryHandler;
    private DiscountCalculatorService $discountCalculatorService;
    private GetDiscountStrategies $getDiscountStrategies;

    protected function setUp(): void
    {
        $this->discountCalculatorService = new DiscountCalculatorService();
        $this->productReadModel = $this->createMock(ProductReadModel::class);
        $this->getDiscountStrategies = new GetDiscountStrategies(
            new InMemoryDiscountStrategyRepository()
        );

        $this->searchCatalogQueryHandler = new SearchCatalogQueryHandler(
            new SearchCatalog($this->productReadModel),
            $this->getDiscountStrategies,
            $this->discountCalculatorService
        );
    }

    protected function tearDown(): void
    {
        unset(
            $this->searchCatalogQueryHandler,
            $this->productReadModel,
            $this->discountCalculatorService,
            $this->getDiscountStrategies,
        );
    }

    /** @test */
    public function shouldReturnProducts(): void
    {
        $criteria = CriteriaMother::withFieldAndOperator('category', 'eq');
        $productsViewModel = ProductsViewModelMother::random();
        $strategies = $this->getDiscountStrategies->__invoke();

        $expectedResponse = ProductsResponseMother::createFromReadModel($productsViewModel, $strategies, $this->discountCalculatorService);

        $this->productReadModel
            ->expects(self::once())
            ->method('search')
            ->with($criteria)
            ->willReturn($productsViewModel);

        $response = $this->searchCatalogQueryHandler->__invoke(
            SearchCatalogQueryMother::fromCriteria($criteria)
        );

        $this->assertEquals($expectedResponse, $response);
    }

    /** @test */
    public function shouldThrowInvalidFilterExceptionWhenFilterFieldIsInvalid(): void
    {
        $this->expectException(InvalidFilter::class);

        $criteria = CriteriaMother::withFieldAndOperator('name', 'eq');

        $this->searchCatalogQueryHandler->__invoke(
            SearchCatalogQueryMother::fromCriteria($criteria)
        );
    }

    /** @test */
    public function shouldThrowInvalidFilterExceptionWhenFilterFieldAndOperatorAreNotAllowed(): void
    {
        $this->expectException(InvalidFilter::class);

        $criteria = CriteriaMother::withFieldAndOperator('category', 'lt');

        $this->searchCatalogQueryHandler->__invoke(
            SearchCatalogQueryMother::fromCriteria($criteria)
        );
    }
}
