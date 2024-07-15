<?php

namespace App\Domain\User\Services;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\User\DataTransferObjects\UserCreateDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserAlreadyExistsException;
use App\Domain\User\Factories\UserFactory;
use App\Domain\User\Repositories\UserReadRepositoryInterface;
use App\Domain\User\Repositories\UserWriteRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserCreateService
{
    public function __construct(
        protected readonly UserReadRepositoryInterface $userReadRepository,
        protected readonly UserWriteRepositoryInterface $userWriteRepository,
        protected readonly UserFactory $userFactory,
        protected readonly OauthClientCreateService $oauthClientCreateService
    ) {
    }

    /**
     * @throws EntityNotSavedException
     * @throws UserAlreadyExistsException
     */
    public function createUser(UserCreateDTO $userCreateDTO): User
    {
        $username = strtolower($userCreateDTO->username);
        $isUserExists = $this->userReadRepository->isExistsUserByUsername($username);

        if ($isUserExists) {
            throw new UserAlreadyExistsException('User with this username already exists');
        }

        try {
            DB::beginTransaction();

            $user = $this->userFactory->createUserModel();
            $this->fillEntity($user, $userCreateDTO);
            $this->userWriteRepository->save($user);

            $this->oauthClientCreateService->createOauthClient($user);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $user;
    }

    protected function fillEntity(User $user, UserCreateDTO $userCreateDTO): void
    {
        $user->setUsername($userCreateDTO->username);
        $user->setPassword($userCreateDTO->password);
    }
}
