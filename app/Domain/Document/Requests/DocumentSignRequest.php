<?php

namespace App\Domain\Document\Requests;

use App\Domain\Base\Requests\BaseRequest;
use App\Domain\Document\DataTransferObjects\DocumentSignDTO;
use App\Domain\User\Entities\User;

/**
 * @property int $document_id
 */
class DocumentSignRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => ['required', 'integer'],
        ];
    }

    public function toDTO(): DocumentSignDTO
    {
        /** @var User $user */
        $user = $this->user();

        return new DocumentSignDTO(
            $this->document_id,
            $user->getId()
        );
    }
}
