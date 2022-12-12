<?php
declare(strict_types=1);

namespace App\Tests\Unit\User\Application\UseCase\User\CreateUser\DTO;

use App\Shared\Domain\Exception\InvalidArgumentException;
use App\User\Application\UseCase\User\CreateUser\DTO\CreateUserInputDTO;
use PHPUnit\Framework\TestCase;

class CreateUserInputDTOTest extends TestCase
{
    private const VALUES = [
        'name' => 'Peter',
        'email' => 'peter@api.com',
        'address' => 'Fake street 123',
        'age' => 30,
        'password' => '123456',
    ];

    public function testCreate(): void
    {
        $dto = CreateUserInputDTO::create(
            self::VALUES['name'],
            self::VALUES['email'],
            self::VALUES['address'],
            self::VALUES['age'],
            self::VALUES['password'],
            null
        );

        self::assertInstanceOf(CreateUserInputDTO::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
        self::assertEquals(self::VALUES['address'], $dto->address);
        self::assertEquals(self::VALUES['age'], $dto->age);
    }

    public function testCreateWithNullValues(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid arguments [password]');

        CreateUserInputDTO::create(
            null,
            self::VALUES['email'],
            self::VALUES['address'],
            null,
            self::VALUES['employeeId'],
            []
        );
    }

    public function testPasswordLengthIsLessThan3(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be min [3] and max [10] characters');

        CreateUserInputDTO::create(
            null,
            self::VALUES['email'],
            self::VALUES['address'],
            self::VALUES['age'],
            '12',
            []
        );
    }

    public function testPasswordLengthIsGreaterThan10(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be min [3] and max [10] characters');

        CreateUserInputDTO::create(
            null,
            self::VALUES['email'],
            self::VALUES['address'],
            self::VALUES['age'],
            '121212121212',
            []
        );
    }

}