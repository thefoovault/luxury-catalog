<?php

declare(strict_types=1);

namespace Test\Catalog\Application\Search;

use Catalog\Application\ProductReadModel;
use Catalog\Application\Search\SearchCatalog;
use Catalog\Application\Search\SearchCatalogQueryHandler;
use PHPUnit\Framework\TestCase;
use Shared\Domain\Criteria\Filter\Exception\InvalidFilter;
use Test\Catalog\Application\ProductsResponseMother;
use Test\Catalog\Shared\Domain\Criteria\CriteriaMother;

final class SearchCatalogQueryHandlerTest extends TestCase
{
    private ProductReadModel $productReadModel;
    private SearchCatalogQueryHandler $searchCatalogQueryHandler;

    protected function setUp(): void
    {
        $this->productReadModel = $this->createMock(ProductReadModel::class);
        $this->searchCatalogQueryHandler = new SearchCatalogQueryHandler(
            new SearchCatalog($this->productReadModel)
        );
    }

    protected function tearDown(): void
    {
        unset(
            $this->searchCatalogQueryHandler,
            $this->productReadModel
        );
    }

    /** @test */
    public function shouldReturnProducts(): void
    {
        $criteria = CriteriaMother::withFieldAndOperator('category', 'eq');
        $productsViewModel = ProductsViewModelMother::random();
        $expectedResponse = ProductsResponseMother::createFromReadModel($productsViewModel);

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
