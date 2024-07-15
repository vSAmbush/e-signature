<?php

namespace App\Domain\SignatureRequest\DataTransferObjects;

final class SignatureRequestCreateDTO
{
    public function __construct(
        public readonly int $documentId,
        public readonly int $senderId,
        public readonly int $signatoryId
    ) {
    }
}
