<?php

namespace App\Domain\SignatureRequest\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $document_id
 * @property int $sender_id
 * @property int $signatory_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class SignatureRequest extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function setDocumentId(int $document_id): self
    {
        $this->document_id = $document_id;

        return $this;
    }

    public function setSenderId(int $sender_id): self
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    public function setSignatoryId(int $signatory_id): self
    {
        $this->signatory_id = $signatory_id;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
