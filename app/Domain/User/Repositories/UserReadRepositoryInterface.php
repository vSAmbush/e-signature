<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

interface UserReadRepositoryInterface
{
    public function findUserByUsername(string $username): User|null;
    public function isExistsUserByUsername(string $username): bool;
    public function isExistsUserById(int $id): bool;
}
