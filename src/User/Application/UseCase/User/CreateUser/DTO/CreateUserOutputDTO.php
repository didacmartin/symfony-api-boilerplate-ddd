<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\CreateUser\DTO;

class CreateUserOutputDTO
{
    public function __construct(public readonly string $id)
    {
    }
}