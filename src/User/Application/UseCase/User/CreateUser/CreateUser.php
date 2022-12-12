<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\CreateUser;

use App\User\Application\UseCase\User\CreateUser\DTO\CreateUserInputDTO;
use App\User\Application\UseCase\User\CreateUser\DTO\CreateUserOutputDTO;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasher;
use App\User\Domain\ValueObject\Uuid;

final class CreateUser
{
    public function __construct(private readonly UserRepository $repository, private readonly PasswordHasher
    $symfonyPasswordHasher)
    {
    }

    public function handle(CreateUserInputDTO $dto): CreateUserOutputDTO
    {
        $roles = $dto->roles;

        if(empty($roles)){
            $roles = [user::DEFAULT_ROLE];
        }

        $user = User::create(Uuid::random()->value(), $dto->name, $dto->email, $dto->address, $dto->age, null, $roles);

        $user->setPassword($this->symfonyPasswordHasher->hashPasswordForUser($user,$dto->password));

        $this->repository->save($user);

        return new CreateUserOutputDTO($user->id());
    }
}