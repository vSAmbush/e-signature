<?php

namespace App\Domain\Document\Requests;

use App\Domain\Document\DataTransferObjects\DocumentAddDTO;
use App\Domain\User\Entities\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property int $file_id
 */
class DocumentAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'file_id' => ['required', 'integer'],
        ];
    }

    public function toDTO(): DocumentAddDTO
    {
        /** @var User $user */
        $user = $this->user();

        return new DocumentAddDTO(
            $this->title,
            $this->file_id,
            $user->getId()
        );
    }
}
