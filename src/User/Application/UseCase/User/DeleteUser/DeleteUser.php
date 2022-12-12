<?php
declare(strict_types=1);

namespace App\User\Application\UseCase\User\DeleteUser;

use App\User\Application\UseCase\User\DeleteUser\DTO\DeleteUserInputDTO;
use App\User\Domain\Repository\UserRepository;

class DeleteUser
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function handle(DeleteUserInputDTO $deleteUserInputDTO): void
    {
        $user = $this->userRepository->findOneByIdOrFail($deleteUserInputDTO->id);

        $this->userRepository->remove($user);
    }
}