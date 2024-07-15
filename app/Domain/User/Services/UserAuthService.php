<?php

namespace App\Domain\User\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\User\DataTransferObjects\UserAuthDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\PasswordNotValidException;

class UserAuthService
{
    public function __construct(
        protected readonly UserDataService $userDataService
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws PasswordNotValidException
     */
    public function authoriseUser(UserAuthDTO $userAuthDTO): User
    {
        $user = $this->userDataService->getUserByUsername($userAuthDTO->username);

        $isPasswordValid = $user->validatePassword($userAuthDTO->password);

        if (! $isPasswordValid) {
            throw new PasswordNotValidException('Wrong password');
        }

        return $user;
    }
}
