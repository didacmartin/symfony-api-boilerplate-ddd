<?php
declare(strict_types=1);

namespace App\User\Application\UseCase\User\ChangeUserPassword\DTO;

use App\User\Domain\Model\User;
use App\User\Domain\Validation\Traits\AssertLengthRangeTrait;
use App\User\Domain\Validation\Traits\AssertNotNullTrait;

class ChangeUserPasswordInputDTO
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'newPassword',
        'currentPassword'
    ];

    public function __construct(public readonly string $userId, public readonly string $currentPassword, public
    readonly
    string $newPassword)
    {
        $this->assertValueRangeLength($this->currentPassword, User::PASSWORD_MIN_LENGTH, User::PASSWORD_MAX_LENGTH);
        $this->assertValueRangeLength($this->newPassword, User::PASSWORD_MIN_LENGTH, User::PASSWORD_MAX_LENGTH);
    }

    public static function create(string $userId, string $currentPassword, string $newPassword): self{
        return new static($userId, $currentPassword, $newPassword);
    }

}