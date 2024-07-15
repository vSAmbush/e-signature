<?php

namespace App\Domain\SignatureRequest\Repositories;

use App\Domain\SignatureRequest\Entities\SignatureRequest;

interface SignatureRequestReadRepositoryInterface
{
    public function isExistsSignatureRequestByDocumentId(int $documentId): bool;
    public function findSignatureRequestBySignatoryIdAndDocumentId(
        int $signatoryId,
        int $documentId
    ): SignatureRequest|null;
    public function findSignatureRequestById(int $id): SignatureRequest|null;
}
