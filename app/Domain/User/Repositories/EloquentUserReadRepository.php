<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

class EloquentUserReadRepository implements UserReadRepositoryInterface
{
    public function findUserByUsername(string $username): User|null
    {
        /** @var User|null */
        return User::query()->where('username', $username)->first();
    }

    public function isExistsUserByUsername(string $username): bool
    {
        return User::query()->where('username', $username)->exists();
    }

    public function isExistsUserById(int $id): bool
    {
        return User::query()->where('id', $id)->exists();
    }
}
