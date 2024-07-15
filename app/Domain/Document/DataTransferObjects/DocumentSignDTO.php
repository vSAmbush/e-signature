<?php

namespace App\Domain\Document\DataTransferObjects;

final class DocumentSignDTO
{
    public function __construct(
        public readonly int $documentId,
        public readonly int $signatoryId
    ) {
    }
}
