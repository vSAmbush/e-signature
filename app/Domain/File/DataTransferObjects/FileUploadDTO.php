<?php

namespace App\Domain\File\DataTransferObjects;

use Illuminate\Http\UploadedFile;

final class FileUploadDTO
{
    public function __construct(
        public readonly UploadedFile $uploadedFile,
        public readonly string $username
    ) {
    }
}
