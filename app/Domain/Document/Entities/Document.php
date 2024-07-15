<?php

namespace App\Domain\Document\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $file_id
 * @property int $owner_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Document extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setFileId(int $fileId): self
    {
        $this->file_id = $fileId;

        return $this;
    }

    public function setOwnerId(int $ownerId): self
    {
        $this->owner_id = $ownerId;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
