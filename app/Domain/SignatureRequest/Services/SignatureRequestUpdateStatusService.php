<?php

namespace App\Domain\SignatureRequest\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\SignatureRequest\Repositories\SignatureRequestWriteRepositoryInterface;

class SignatureRequestUpdateStatusService
{
    public function __construct(
        protected readonly SignatureRequestDataService $signatureRequestDataService,
        protected readonly SignatureRequestWriteRepositoryInterface $signatureRequestWriteRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws EntityNotSavedException
     */
    public function updateStatus(int $signatureRequestId, int $status): void
    {
        $signatureRequest = $this->signatureRequestDataService->getSignatureRequestById($signatureRequestId);

        $signatureRequest->setStatus($status);
        $this->signatureRequestWriteRepository->save($signatureRequest);
    }
}
