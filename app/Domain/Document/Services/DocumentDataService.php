<?php

namespace App\Domain\Document\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\Document\Entities\Document;
use App\Domain\Document\Enums\DocumentStatusEnum;
use App\Domain\Document\Repositories\DocumentReadRepositoryInterface;

class DocumentDataService
{
    public function __construct(
        protected readonly DocumentReadRepositoryInterface $documentReadRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getDocumentById(int $id): Document
    {
        $document = $this->documentReadRepository->findDocumentById($id);

        if (empty($document)) {
            throw new EntityNotFoundException('Document has not been found');
        }

        return $document;
    }

    public function isDocumentEligibleForSignatureRequest(int $documentId): bool
    {
        return $this->documentReadRepository->isDocumentExistsByIdAndStatus(
            $documentId,
            DocumentStatusEnum::NEW->value
        );
    }

    public function isDocumentOwnedByUserId(int $userId): bool
    {
        return $this->documentReadRepository->isDocumentExistsByOwnerId($userId);
    }
}
