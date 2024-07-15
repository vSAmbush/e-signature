<?php

namespace App\Domain\File\Requests;

use App\Domain\Base\Requests\BaseRequest;
use App\Domain\File\DataTransferObjects\FileUploadDTO;
use App\Domain\User\Entities\User;

class FileUploadRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|mimetypes:application/pdf|max:8192',
        ];
    }

    public function toDTO(): FileUploadDTO
    {
        /** @var User $user */
        $user = $this->user();

        return new FileUploadDTO(
            $this->file('file'),
            $user->getUsername()
        );
    }
}
