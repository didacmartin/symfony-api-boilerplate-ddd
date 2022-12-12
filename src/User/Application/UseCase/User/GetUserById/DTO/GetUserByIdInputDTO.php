<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\GetUserById\DTO;

use App\User\Domain\Validation\Traits\AssertNotNullTrait;

class GetUserByIdInputDTO
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public readonly ?string $id
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}