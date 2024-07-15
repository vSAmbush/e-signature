<?php

namespace App\Domain\User\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\User\Entities\User;

interface UserWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(User $user);
}
