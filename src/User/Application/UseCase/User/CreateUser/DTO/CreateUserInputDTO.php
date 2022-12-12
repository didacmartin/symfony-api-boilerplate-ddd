<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\User\CreateUser\DTO;


use App\User\Domain\Model\User;
use App\User\Domain\Validation\Traits\AssertLengthRangeTrait;
use App\User\Domain\Validation\Traits\AssertMinimumAgeTrait;
use App\User\Domain\Validation\Traits\AssertNotNullTrait;

class CreateUserInputDTO
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;
    use AssertMinimumAgeTrait;

    private const ARGS = [
        'email',
        'password',
    ];
    private const MINIMUM_AGE = 18;

    private function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $address,
        public readonly ?int $age,
        public readonly ?string $password,
        public readonly ?array $roles
    ) {
        $this->assertNotNull(self::ARGS, [$this->email, $this->password]);

        if (!\is_null($this->password)) {
            $this->assertValueRangeLength($this->password, User::PASSWORD_MIN_LENGTH, User::PASSWORD_MAX_LENGTH);
        }
    }

    public static function create(?string $name, ?string $email, ?string $address, ?int $age, ?string $password,
                                  ?array $roles): self
    {
        return new static($name, $email, $address, $age, $password, $roles);
    }
}