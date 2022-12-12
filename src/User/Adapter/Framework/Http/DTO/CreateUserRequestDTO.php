<?php

declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\DTO;

use Symfony\Component\HttpFoundation\Request;

class CreateUserRequestDTO implements RequestDTO
{
    public readonly ?string $name;
    public readonly ?string $email;
    public readonly ?string $address;
    public readonly ?int $age;
    public readonly string $password;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->email = $request->request->get('email');
        $this->address = $request->request->get('address');
        $this->age = $request->request->get('age');
        $this->password = $request->request->get('password');
    }
}