<?php

declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\DTO;

use Symfony\Component\HttpFoundation\Request;

class GetUserByIdRequestDTO implements RequestDTO
{
    public readonly ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}