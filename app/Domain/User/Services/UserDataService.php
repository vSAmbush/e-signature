<?php

namespace App\Domain\User\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserReadRepositoryInterface;

class UserDataService
{
    public function __construct(
        protected readonly UserReadRepositoryInterface $userReadRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getUserByUsername(string $username): User
    {
        $user = $this->userReadRepository->findUserByUsername($username);

        if (empty($user)) {
            throw new EntityNotFoundException('User with this username is absent');
        }

        return $user;
    }
}
