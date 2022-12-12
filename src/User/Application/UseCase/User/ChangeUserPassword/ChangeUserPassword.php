<?php
declare(strict_types=1);

namespace App\User\Application\UseCase\User\ChangeUserPassword;

use App\User\Application\UseCase\User\ChangeUserPassword\DTO\ChangeUserPasswordInputDTO;
use App\User\Domain\Exception\InvalidPasswordException;
use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasher;

final class ChangeUserPassword
{
    public function __construct(private readonly UserRepository $userRepository, private readonly PasswordHasher $passwordHasher)
    {
    }

    public function handle(ChangeUserPasswordInputDTO $changeUserPasswordInputDTO){

        $user = $this->userRepository->findOneByIdOrFail($changeUserPasswordInputDTO->userId);

        if (!$this->passwordHasher->isPasswordValid($user, $changeUserPasswordInputDTO->currentPassword)) {
            throw new InvalidPasswordException('Invalid current password!');
        }

        $user->setPassword($this->passwordHasher->hashPasswordForUser($user, $changeUserPasswordInputDTO->newPassword));

        $this->userRepository->save($user);
    }
}