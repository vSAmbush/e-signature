<?php

namespace App\Domain\SignatureRequest\Repositories;

use App\Domain\SignatureRequest\Entities\SignatureRequest;

class EloquentSignatureRequestReadRepository implements SignatureRequestReadRepositoryInterface
{
    public function isExistsSignatureRequestByDocumentId(int $documentId): bool
    {
        return SignatureRequest::query()->where('document_id', $documentId)->exists();
    }

    public function findSignatureRequestBySignatoryIdAndDocumentId(
        int $signatoryId,
        int $documentId
    ): SignatureRequest|null {
        /** @var SignatureRequest|null */
        return SignatureRequest::query()
            ->where('document_id', $documentId)
            ->where('signatory_id', $signatoryId)
            ->first();
    }

    public function findSignatureRequestById(int $id): SignatureRequest|null
    {
        /** @var SignatureRequest|null */
        return SignatureRequest::query()->where('id', $id)->first();
    }
}
