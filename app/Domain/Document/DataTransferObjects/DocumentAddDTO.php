<?php

namespace App\Domain\Document\DataTransferObjects;

final class DocumentAddDTO
{
    public function __construct(
        public readonly string $title,
        public readonly int $fileId,
        public readonly int $ownerId
    ) {
    }
}
