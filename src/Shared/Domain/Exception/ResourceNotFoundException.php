<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

class ResourceNotFoundException extends \DomainException
{
    public static function createFromClassAndId(string $class, string $id): self
    {
        return new static(\sprintf('Resource of type [%s] with ID [%s] not found', $class, $id));
    }
    public static function createFromClassAndEmail(string $class, string $email): self
    {
        return new static(\sprintf('Resource of type [%s] with EMAIL [%s] not found', $class, $email));
    }
}