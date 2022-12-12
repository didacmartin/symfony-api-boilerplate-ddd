<?php
declare(strict_types=1);

namespace App\User\Adapter\Security;

use App\User\Domain\Model\User;
use App\User\Domain\Security\SecurityUserCustom;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements SecurityUserCustom, UserInterface,
    PasswordAuthenticatedUserInterface
{
    public $id;
    public $email;
    public $password;
    public $roles;

    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->email = $user->email();
        $this->password = $user->password();
        $this->roles = $user->roles();
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        $this->password = null;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
}