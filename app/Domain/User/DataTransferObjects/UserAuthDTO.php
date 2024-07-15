<?php

namespace App\Domain\User\DataTransferObjects;

final class UserAuthDTO
{
    public function __construct(
        public readonly string $username,
        public readonly string $password
    ) {
    }
}
