<?php
declare(strict_types=1);

namespace App\User\Domain\Security;

interface SecurityUserCustom
{
    public function getPassword(): ?string;
}