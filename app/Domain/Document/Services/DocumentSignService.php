<?php

namespace App\Domain\Document\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\DataTransferObjects\DocumentSignDTO;
use App\Domain\Document\Enums\DocumentStatusEnum;
use App\Domain\SignatureRequest\Enums\SignatureRequestStatusEnum;
use App\Domain\SignatureRequest\Services\SignatureRequestDataService;
use App\Domain\SignatureRequest\Services\SignatureRequestUpdateStatusService;
use Exception;
use Illuminate\Support\Facades\DB;

class DocumentSignService
{
    public function __construct(
        protected readonly SignatureRequestDataService $signatureRequestDataService,
        protected readonly DocumentUpdateStatusService $documentUpdateStatusService,
        protected readonly SignatureRequestUpdateStatusService $signatureRequestUpdateStatusService
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws EntityNotSavedException
     */
    public function singDocument(DocumentSignDTO $documentSignDTO): void
    {
        $signatureRequest = $this->signatureRequestDataService->getSignatureRequestBySignatoryIdAndDocumentId(
            $documentSignDTO->signatoryId,
            $documentSignDTO->documentId
        );

        DB::beginTransaction();
        try {
            $this->documentUpdateStatusService->updateStatus(
                $documentSignDTO->documentId,
                DocumentStatusEnum::SIGNED->value
            );
            $this->signatureRequestUpdateStatusService->updateStatus(
                $signatureRequest->id,
                SignatureRequestStatusEnum::SIGNED->value
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
