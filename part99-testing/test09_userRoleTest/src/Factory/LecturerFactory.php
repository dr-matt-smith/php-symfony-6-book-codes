<?php

namespace App\Factory;

use App\Entity\Lecturer;
use App\Repository\LecturerRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Lecturer>
 *
 * @method static Lecturer|Proxy createOne(array $attributes = [])
 * @method static Lecturer[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Lecturer|Proxy find(object|array|mixed $criteria)
 * @method static Lecturer|Proxy findOrCreate(array $attributes)
 * @method static Lecturer|Proxy first(string $sortedField = 'id')
 * @method static Lecturer|Proxy last(string $sortedField = 'id')
 * @method static Lecturer|Proxy random(array $attributes = [])
 * @method static Lecturer|Proxy randomOrCreate(array $attributes = [])
 * @method static Lecturer[]|Proxy[] all()
 * @method static Lecturer[]|Proxy[] findBy(array $attributes)
 * @method static Lecturer[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Lecturer[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LecturerRepository|RepositoryProxy repository()
 * @method Lecturer|Proxy create(array|callable $attributes = [])
 */
final class LecturerFactory extends ModelFactory
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
            // ->afterInstantiate(function(Lecturer $lecturer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Lecturer::class;
    }
}
