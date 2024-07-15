<?php

namespace App\Domain\File\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $path
 * @property int $size
 * @property int $created_at
 * @property int $updated_at
 */
class File extends Model
{
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFileName(): string
    {
        return $this->file_name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function setMimeType(string $mime_type): self
    {
        $this->mime_type = $mime_type;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }
}
