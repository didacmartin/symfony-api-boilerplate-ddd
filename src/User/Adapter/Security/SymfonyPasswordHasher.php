<?php
declare(strict_types=1);

namespace App\User\Adapter\Security;

use App\User\Domain\Security\PasswordHasher;
use App\User\Domain\Security\SecurityUserCustom;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyPasswordHasher implements PasswordHasher
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {

    }

    public function hashPasswordForUser($user, string $password): string
    {

        return $this->passwordHasher->hashPassword(new SecurityUser($user), $password);
    }
    //Todo no entenc cóm extreure el passwerHasher perque la interface necessita user implementant
    // PasswordAuthenticatedUserInterface.
    public function isPasswordValid($user, string $plainPassword): bool
    {
        return $this->passwordHasher->isPasswordValid(new SecurityUser($user), $plainPassword);
    }
}