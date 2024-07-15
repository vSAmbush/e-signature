<?php

namespace App\Domain\User\Factories;

use App\Domain\User\Entities\User;

class UserFactory
{
    public function createUserModel(): User
    {
        return new User();
    }
}
