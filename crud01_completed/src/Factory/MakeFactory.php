<?php

namespace App\Factory;

use App\Entity\Make;
use App\Repository\MakeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Make>
 *
 * @method static Make|Proxy createOne(array $attributes = [])
 * @method static Make[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Make|Proxy find(object|array|mixed $criteria)
 * @method static Make|Proxy findOrCreate(array $attributes)
 * @method static Make|Proxy first(string $sortedField = 'id')
 * @method static Make|Proxy last(string $sortedField = 'id')
 * @method static Make|Proxy random(array $attributes = [])
 * @method static Make|Proxy randomOrCreate(array $attributes = [])
 * @method static Make[]|Proxy[] all()
 * @method static Make[]|Proxy[] findBy(array $attributes)
 * @method static Make[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Make[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MakeRepository|RepositoryProxy repository()
 * @method Make|Proxy create(array|callable $attributes = [])
 */
final class MakeFactory extends ModelFactory
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
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Make $make): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Make::class;
    }
}
