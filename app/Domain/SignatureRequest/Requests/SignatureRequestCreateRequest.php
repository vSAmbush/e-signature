<?php

namespace App\Domain\SignatureRequest\Requests;

use App\Domain\Base\Requests\BaseRequest;
use App\Domain\SignatureRequest\DataTransferObjects\SignatureRequestCreateDTO;
use App\Domain\User\Entities\User;

/**
 * @property int $document_id
 * @property int $signatory_id
 */
class SignatureRequestCreateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => ['required', 'integer'],
            'signatory_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    /** @var User $user */
                    $user = $this->user();

                    if ($user && $user->getId() === $value) {
                        $fail('The ' . $attribute . ' must not match the current user ID.');
                    }
                },
            ],
        ];
    }

    public function toDTO(): SignatureRequestCreateDTO
    {
        /** @var User $user */
        $user = $this->user();

        return new SignatureRequestCreateDTO(
            $this->document_id,
            $user->getId(),
            $this->signatory_id
        );
    }
}
