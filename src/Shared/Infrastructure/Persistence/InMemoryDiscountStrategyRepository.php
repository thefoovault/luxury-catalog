<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence;

use Shared\Domain\Discount\DiscountStrategy\CategoryPercentageStrategy;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategies;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategy;
use Shared\Domain\Discount\DiscountStrategy\DiscountStrategyRepository;
use Shared\Domain\Discount\DiscountStrategy\InvalidDiscountStrategy;
use Shared\Domain\Discount\DiscountStrategy\NoPercentageStrategy;
use Shared\Domain\Discount\DiscountStrategy\SkuPercentageStrategy;
use Shared\Domain\Discount\Product\ProductCategory;
use Shared\Domain\Discount\Product\ProductSku;
use Shared\Domain\ValueObject\Percentage;

final class InMemoryDiscountStrategyRepository implements DiscountStrategyRepository
{
    private static array $strategies = [
        [
            'type' => 'category',
            'percentage' => 30,
            'value' => 'boots',
        ],
        [
            'type' => 'sku',
            'percentage' => 15,
            'value' => '000003',
        ],
    ];

    public function discountStrategiesOrderedByPercentage(): DiscountStrategies
    {
        $discountStrategies = new DiscountStrategies([]);

        foreach (self::$strategies as $strategy) {
            $discountStrategies->add($this->createDiscountStrategy($strategy));
        }

        return $discountStrategies;
    }

    private function createDiscountStrategy(array $strategy): DiscountStrategy
    {
        return match ($strategy['type']) {
            'category'=> new CategoryPercentageStrategy(
                new ProductCategory($strategy['value']),
                new Percentage($strategy['percentage'])
            ),
            'sku' => new SkuPercentageStrategy(
                new ProductSku($strategy['value']),
                new Percentage($strategy['percentage'])
            ),
            default => throw new InvalidDiscountStrategy($strategy['type'])
        };
    }
}
