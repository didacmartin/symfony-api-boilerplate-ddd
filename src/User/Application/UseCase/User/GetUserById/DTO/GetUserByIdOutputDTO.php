<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\GetUserById\DTO;

use App\User\Domain\Model\User;

class GetUserByIdOutputDTO
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $address,
        public readonly int $age,
    ) {
    }

    public static function create(User $customer): self
    {
        return new self(
            $customer->id(),
            $customer->name(),
            $customer->email(),
            $customer->address(),
            $customer->age(),
        );
    }
}