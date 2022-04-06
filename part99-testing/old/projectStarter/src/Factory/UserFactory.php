<?php
// src/Factory/UserFactory.php

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;


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
//            'email' => self::faker()->unique()->safeEmail(),
//            'password' => '1234',
        ];
    }

    protected function initialize(): self
    {
        return $this
        ->afterInstantiate(function(User $user) {
            $plainPassword = $user->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

//            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}