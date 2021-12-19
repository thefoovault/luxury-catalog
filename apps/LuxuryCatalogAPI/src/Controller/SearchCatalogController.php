<?php

declare(strict_types=1);

namespace LuxuryCatalogAPI\Controller;

use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SearchCatalogController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        return $this->createApiResponse(null);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
