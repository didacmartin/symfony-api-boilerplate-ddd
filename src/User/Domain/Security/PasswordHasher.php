<?php
declare(strict_types=1);

namespace App\User\Domain\Security;


interface PasswordHasher
{
    public function hashPasswordForUser($user, string $password): string;

    public function isPasswordValid($user, string $plainPassword): bool;
}