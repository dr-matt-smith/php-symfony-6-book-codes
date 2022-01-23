<?php

namespace App\Factory;

use App\Entity\Campus;
use App\Repository\CampusRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Campus>
 *
 * @method static Campus|Proxy createOne(array $attributes = [])
 * @method static Campus[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Campus|Proxy find(object|array|mixed $criteria)
 * @method static Campus|Proxy findOrCreate(array $attributes)
 * @method static Campus|Proxy first(string $sortedField = 'id')
 * @method static Campus|Proxy last(string $sortedField = 'id')
 * @method static Campus|Proxy random(array $attributes = [])
 * @method static Campus|Proxy randomOrCreate(array $attributes = [])
 * @method static Campus[]|Proxy[] all()
 * @method static Campus[]|Proxy[] findBy(array $attributes)
 * @method static Campus[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Campus[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CampusRepository|RepositoryProxy repository()
 * @method Campus|Proxy create(array|callable $attributes = [])
 */
final class CampusFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'location' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Campus $campus): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Campus::class;
    }
}
