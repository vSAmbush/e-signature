<?php

namespace App\Domain\User\Requests;

use App\Domain\Base\Requests\BaseRequest;
use App\Domain\User\DataTransferObjects\UserAuthDTO;

/**
 * @property string $username
 * @property string $password
 */
class UserLoginRequest extends BaseRequest
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

    public function toDTO(): UserAuthDTO
    {
        return new UserAuthDTO(
            $this->username,
            $this->password
        );
    }
}
