<?php
declare(strict_types=1);

namespace App\Tests\Unit\User\Application\UseCase\User\DeleteUser;

use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\User\Application\UseCase\User\DeleteUser\DeleteUser;
use App\User\Application\UseCase\User\DeleteUser\DTO\DeleteUserInputDTO;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteUserTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private DeleteUser $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepository::class);

        $this->useCase = new DeleteUser($this->userRepository);
    }

    public function testDeleteUser(): void
    {
        $userId = '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae';

        $user = User::create(
            $userId,
            'Juan',
            'peter@api.com',
            'Fake street 123',
            30,
            '123456',
            []
        );

        $inputDTO = DeleteUserInputDTO::create($userId);

        $this->userRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($userId)
            ->willReturn($user);

        $this->userRepository
            ->expects($this->once())
            ->method('remove')
            ->with($user);

        $this->useCase->handle($inputDTO);
    }
    public function testDeleteNonExistingUser(): void
    {
        $userId = '37fb348b-891a-4b1c-a4e4-a4a68a3c6b33';

        $user = User::create(
            $userId,
            'Juan',
            'peter@api.com',
            'Fake street 123',
            30,
            '123456',
            []
        );

        $inputDTO = DeleteUserInputDTO::create($userId);

        $this->expectException(ResourceNotFoundException::class);

        $this->userRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($userId)
            ->willThrowException(ResourceNotFoundException::createFromClassAndId(User::class, $userId));

        $this->useCase->handle($inputDTO);
    }
}