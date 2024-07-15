<?php

namespace App\Domain\User\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\User\Entities\User;

class EloquentUserWriteRepository implements UserWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(User $user): void
    {
        $isSaved = $user->save();

        if (! $isSaved) {
            throw new EntityNotSavedException('User has not been saved');
        }
    }
}
