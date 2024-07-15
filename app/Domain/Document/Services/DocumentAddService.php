<?php

namespace App\Domain\Document\Services;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\DataTransferObjects\DocumentAddDTO;
use App\Domain\Document\Entities\Document;
use App\Domain\Document\Enums\DocumentStatusEnum;
use App\Domain\Document\Factories\DocumentFactory;
use App\Domain\Document\Repositories\DocumentWriteRepositoryInterface;

class DocumentAddService
{
    public function __construct(
        protected readonly DocumentFactory $documentFactory,
        protected readonly DocumentWriteRepositoryInterface $documentWriteRepository
    ) {
    }

    /**
     * @throws EntityNotSavedException
     */
    public function addDocument(DocumentAddDTO $documentAddDTO): Document
    {
        $document = $this->documentFactory->createDocument();
        $this->fillEntity($document, $documentAddDTO);

        $this->documentWriteRepository->save($document);

        return $document;
    }

    protected function fillEntity(Document $document, DocumentAddDTO $documentAddDTO): void
    {
        $document->setTitle($documentAddDTO->title);
        $document->setFileId($documentAddDTO->fileId);
        $document->setOwnerId($documentAddDTO->ownerId);
        $document->setStatus(DocumentStatusEnum::NEW->value);
    }
}
