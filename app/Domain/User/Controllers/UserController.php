<?php

namespace App\Domain\User\Controllers;

use App\Domain\Base\Exception\BaseException;
use App\Domain\User\Requests\UserCreateRequest;
use App\Domain\User\Requests\UserLoginRequest;
use App\Domain\User\Resources\UserCreatedResource;
use App\Domain\User\Resources\UserInfoResource;
use App\Domain\User\Services\UserCreateService;
use App\Domain\User\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserCreateService $userCreateService,
        protected readonly UserAuthService $userDataService
    ) {
    }

    public function register(UserCreateRequest $userCreateRequest): JsonResponse
    {
        $dto = $userCreateRequest->toDTO();

        try {
            $user = $this->userCreateService->createUser($dto);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }

        return (new UserCreatedResource($user))->response()->setStatusCode(201);
    }

    public function login(UserLoginRequest $userLoginRequest): UserInfoResource|JsonResponse
    {
        $dto = $userLoginRequest->toDTO();

        try {
            $user = $this->userDataService->authoriseUser($dto);

            return new UserInfoResource($user);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }
}
