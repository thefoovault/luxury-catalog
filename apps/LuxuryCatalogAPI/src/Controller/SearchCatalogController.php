<?php

declare(strict_types=1);

namespace LuxuryCatalogAPI\Controller;

use Catalog\Application\Search\SearchCatalogQuery;
use Shared\Domain\Criteria\Filter\Exception\InvalidFilter;
use Shared\Domain\Criteria\Filter\Exception\InvalidOperator;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SearchCatalogController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $response = $this->ask(
            new SearchCatalogQuery(
                (array) $request->query->get('filter')
            )
        );

        return $this->createApiResponse($response);
    }

    protected function exceptions(): array
    {
        return [
            InvalidFilter::class => Response::HTTP_BAD_REQUEST,
            InvalidOperator::class => Response::HTTP_BAD_REQUEST
        ];
    }
}
