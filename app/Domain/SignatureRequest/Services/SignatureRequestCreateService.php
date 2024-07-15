<?php

namespace App\Domain\SignatureRequest\Services;

use App\Domain\Base\Exception\EntityNotFoundException;
use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\Enums\DocumentStatusEnum;
use App\Domain\Document\Repositories\DocumentReadRepositoryInterface;
use App\Domain\Document\Services\DocumentDataService;
use App\Domain\Document\Services\DocumentUpdateStatusService;
use App\Domain\SignatureRequest\DataTransferObjects\SignatureRequestCreateDTO;
use App\Domain\SignatureRequest\Entities\SignatureRequest;
use App\Domain\SignatureRequest\Enums\SignatureRequestStatusEnum;
use App\Domain\SignatureRequest\Exceptions\DocumentIsNowOwnedByUserException;
use App\Domain\SignatureRequest\Exceptions\DocumentNotEligibleException;
use App\Domain\SignatureRequest\Exceptions\SignatureRequestAlreadyExistsException;
use App\Domain\SignatureRequest\Factories\SignatureRequestFactory;
use App\Domain\SignatureRequest\Repositories\SignatureRequestReadRepositoryInterface;
use App\Domain\SignatureRequest\Repositories\SignatureRequestWriteRepositoryInterface;
use App\Domain\User\Repositories\UserReadRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class SignatureRequestCreateService
{
    public function __construct(
        protected readonly DocumentDataService $documentDataService,
        protected readonly UserReadRepositoryInterface $userReadRepository,
        protected readonly SignatureRequestFactory $signatureRequestFactory,
        protected readonly SignatureRequestWriteRepositoryInterface $signatureRequestWriteRepository,
        protected readonly SignatureRequestDataService $signatureRequestDataService,
        protected readonly DocumentUpdateStatusService $documentUpdateStatusService
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws EntityNotSavedException
     * @throws DocumentNotEligibleException
     * @throws DocumentIsNowOwnedByUserException
     * @throws SignatureRequestAlreadyExistsException
     */
    public function createSignatureRequest(SignatureRequestCreateDTO $signatureRequestCreateDTO): SignatureRequest
    {
        $this->validateDocumentEligibility($signatureRequestCreateDTO->documentId);
        $this->validateDocumentOwnedBySender($signatureRequestCreateDTO->senderId);
        $this->validateSignatoryExists($signatureRequestCreateDTO->signatoryId);
        $this->validateSignatureRequestExists($signatureRequestCreateDTO->documentId);

        DB::beginTransaction();

        try {
            $signatureRequest = $this->signatureRequestFactory->createSignatureRequestModel();
            $this->fillEntity($signatureRequest, $signatureRequestCreateDTO);
            $this->signatureRequestWriteRepository->save($signatureRequest);

            $this->documentUpdateStatusService->updateStatus(
                $signatureRequestCreateDTO->documentId,
                DocumentStatusEnum::ON_SIGNING->value
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $signatureRequest;
    }

    /**
     * @throws DocumentNotEligibleException
     */
    protected function validateDocumentEligibility(int $documentId): void
    {
        $isDocumentEligible = $this->documentDataService->isDocumentEligibleForSignatureRequest(
            $documentId
        );

        if (! $isDocumentEligible) {
            throw new DocumentNotEligibleException('There are no new documents to sign');
        }
    }

    /**
     * @throws DocumentIsNowOwnedByUserException
     */
    protected function validateDocumentOwnedBySender(int $senderId): void
    {
        $isDocumentExists = $this->documentDataService->isDocumentOwnedByUserId($senderId);

        if (! $isDocumentExists) {
            throw new DocumentIsNowOwnedByUserException('Document with this id does not belong to you');
        }
    }

    /**
     * @throws EntityNotFoundException
     */
    protected function validateSignatoryExists(int $signatoryId): void
    {
        $isSignatoryExists = $this->userReadRepository->isExistsUserById($signatoryId);

        if (! $isSignatoryExists) {
            throw new EntityNotFoundException('User with this signatory id is not found');
        }
    }

    /**
     * @throws SignatureRequestAlreadyExistsException
     */
    protected function validateSignatureRequestExists(int $documentId): void
    {
        $isSignatureRequestAlreadyExists = $this->signatureRequestDataService->isDocumentAlreadyHasSignatureRequest(
            $documentId
        );

        if ($isSignatureRequestAlreadyExists) {
            throw new SignatureRequestAlreadyExistsException('Signature request already exists');
        }
    }

    protected function fillEntity(
        SignatureRequest $signatureRequest,
        SignatureRequestCreateDTO $signatureRequestCreateDTO
    ): void {
        $signatureRequest->setDocumentId($signatureRequestCreateDTO->documentId);
        $signatureRequest->setSenderId($signatureRequestCreateDTO->senderId);
        $signatureRequest->setSignatoryId($signatureRequestCreateDTO->signatoryId);
        $signatureRequest->setStatus(SignatureRequestStatusEnum::PENDING->value);
    }
}
