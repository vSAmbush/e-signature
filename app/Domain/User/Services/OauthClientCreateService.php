<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\User;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class OauthClientCreateService
{
    public function __construct(
        protected readonly ClientRepository $clientRepository
    ) {
    }

    public function createOauthClient(User $user): Client
    {
        return $this->clientRepository->createPersonalAccessClient($user->id, $user->username, Request::getHost());
    }
}
