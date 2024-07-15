<?php

namespace App\Domain\SignatureRequest\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\SignatureRequest\Entities\SignatureRequest;
use App\Domain\SignatureRequest\Repositories\SignatureRequestReadRepositoryInterface;

class SignatureRequestDataService
{
    public function __construct(
        protected readonly SignatureRequestReadRepositoryInterface $signatureRequestReadRepository
    ) {
    }

    public function isDocumentAlreadyHasSignatureRequest(int $documentId): bool
    {
        return $this->signatureRequestReadRepository->isExistsSignatureRequestByDocumentId($documentId);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getSignatureRequestBySignatoryIdAndDocumentId(int $signatoryId, int $documentId): SignatureRequest
    {
        $signatureRequest = $this->signatureRequestReadRepository->findSignatureRequestBySignatoryIdAndDocumentId(
            $signatoryId,
            $documentId
        );

        if (empty($signatureRequest)) {
            throw new EntityNotFoundException(
                'Signature request for this signatory and document has not been found'
            );
        }

        return $signatureRequest;
    }

    public function getSignatureRequestById(int $id): SignatureRequest
    {
        $signatureRequest = $this->signatureRequestReadRepository->findSignatureRequestById($id);

        if (empty($signatureRequest)) {
            throw new EntityNotFoundException('Signature request with this id has not been found');
        }

        return $signatureRequest;
    }
}
