<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


final class UserFactory extends ModelFactory
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
    }

    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->unique()->safeEmail(),
            'roles' => [],
            'password' => 'password'
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(User $user) {
                $plainPassword = $user->getPassword();
                $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            });
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
