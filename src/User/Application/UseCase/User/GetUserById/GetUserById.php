<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\GetUserById;

use App\User\Application\UseCase\User\GetUserById\DTO\GetUserByIdInputDTO;
use App\User\Application\UseCase\User\GetUserById\DTO\GetUserByIdOutputDTO;
use App\User\Domain\Repository\UserRepository;

class GetUserById
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function handle(GetUserByIdInputDTO $dto): GetUserByIdOutputDTO
    {
        return GetUserByIdOutputDTO::create($this->userRepository->findOneByIdOrFail($dto->id));
    }
}