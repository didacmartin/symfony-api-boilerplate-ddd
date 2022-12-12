<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Model\User;

interface UserRepository
{
    public function findOneByIdOrFail(string $id): User;

    public function findOneByEmailOrFail(string $email): User;

    public function save(User $user): void;

    public function remove(User $user): void;
}