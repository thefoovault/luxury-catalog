<?php

declare(strict_types=1);

namespace LuxuryCatalogAPI\Controller;

use Catalog\Application\Search\SearchCatalogQuery;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SearchCatalogController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $response = $this->ask(
            new SearchCatalogQuery()
        );

        return $this->createApiResponse($response);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
