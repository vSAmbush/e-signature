<?php

namespace App\Domain\User\DataTransferObjects;

final class UserCreateDTO
{
    public function __construct(
        public readonly string $username,
        public readonly string $password
    ) {
    }
}
