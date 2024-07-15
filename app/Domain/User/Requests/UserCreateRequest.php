<?php

namespace App\Domain\User\Requests;

use App\Domain\Base\Requests\BaseRequest;
use App\Domain\User\DataTransferObjects\UserCreateDTO;

/**
 * @property string $username
 * @property string $password
 */
class UserCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'min:3',
                'max:255',
                'regex:/^[a-zA-Z0-9-_]+$/'
            ],
            'password' => [
                'required',
                'min:8',
                'max:255',
                'regex:/^[a-zA-Z0-9-_$#*]+$/'
            ],
        ];
    }

    public function toDTO(): UserCreateDTO
    {
        return new UserCreateDTO(
            $this->username,
            $this->password
        );
    }
}
