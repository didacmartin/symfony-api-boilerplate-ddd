<?php
declare(strict_types=1);

namespace App\User\Domain\Model;

class User
{
    public const PASSWORD_MIN_LENGTH = 3;
    public const PASSWORD_MAX_LENGTH = 10;
    public const DEFAULT_ROLE = 'ROLE_USER';

    public function __construct(
        private readonly string $id,
        private string $name,
        private string $email,
        private string $address,
        private int $age,
        private ?string $password,
        private ?array $roles
    ) {
    }

    public static function create(string $id, string $name, string $email, string $address, int $age, ?string $password,
?array $roles): self
    {
        return new static($id, $name, $email, $address, $age, $password, $roles);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function roles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = self::DEFAULT_ROLE;

        return array_unique($roles);
    }

    public function setRoles(?array $roles): self
    {

        $this->roles = $roles;

        return $this;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function password(): ?string{
        return $this->password;
    }

}