<?php

namespace App\Factory;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Student>
 *
 * @method static Student|Proxy createOne(array $attributes = [])
 * @method static Student[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Student|Proxy find(object|array|mixed $criteria)
 * @method static Student|Proxy findOrCreate(array $attributes)
 * @method static Student|Proxy first(string $sortedField = 'id')
 * @method static Student|Proxy last(string $sortedField = 'id')
 * @method static Student|Proxy random(array $attributes = [])
 * @method static Student|Proxy randomOrCreate(array $attributes = [])
 * @method static Student[]|Proxy[] all()
 * @method static Student[]|Proxy[] findBy(array $attributes)
 * @method static Student[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Student[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static StudentRepository|RepositoryProxy repository()
 * @method Student|Proxy create(array|callable $attributes = [])
 */
final class StudentFactory extends ModelFactory
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
            'age' => self::faker()->randomNumber(),
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Student $student): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Student::class;
    }
}
