<?php
declare(strict_types=1);

namespace App\User\Application\UseCase\User\DeleteUser\DTO;

use App\Shared\Domain\Exception\InvalidArgumentException;

final class DeleteUserInputDTO
{
    private function __construct(
        public readonly string $id
    ) {
    }

    public static function create(?string $id): self
    {
        if (\is_null($id)) {
            throw InvalidArgumentException::createFromMessage('Customer ID can\'t be null');
        }

        return new static($id);
    }
}