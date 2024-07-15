<?php

namespace App\Domain\Document\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\Repositories\DocumentWriteRepositoryInterface;

class DocumentUpdateStatusService
{
    public function __construct(
        protected readonly DocumentDataService $documentDataService,
        protected readonly DocumentWriteRepositoryInterface $documentWriteRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws EntityNotSavedException
     */
    public function updateStatus(int $documentId, int $status): void
    {
        $document = $this->documentDataService->getDocumentById($documentId);

        $document->setStatus($status);

        $this->documentWriteRepository->save($document);
    }
}
