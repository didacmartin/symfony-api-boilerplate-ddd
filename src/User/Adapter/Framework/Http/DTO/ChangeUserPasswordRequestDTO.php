<?php
declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeUserPasswordRequestDTO implements RequestDTO
{
    #[Assert\NotNull]
    public readonly string $id;
    #[Assert\NotNull]
    public readonly string $newPassword;
    #[Assert\NotNull]
    public readonly string $oldPassword;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
        $this->newPassword = $request->request->get('newPassword');
        $this->oldPassword = $request->request->get('oldPassword');
    }
}