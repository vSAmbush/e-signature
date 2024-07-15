<?php

namespace App\Domain\File\Services;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\File\DataTransferObjects\FileUploadDTO;
use App\Domain\File\Entities\File;
use App\Domain\File\Factories\FileFactory;
use App\Domain\File\Repositories\FileWriteRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function __construct(
        protected readonly FileFactory $fileFactory,
        protected readonly FileWriteRepositoryInterface $fileWriteRepository
    ) {

    }

    /**
     * @throws EntityNotSavedException
     */
    public function saveFile(string $path, FileUploadDTO $fileUploadDTO): File
    {
        $this->storeFile($path, $fileUploadDTO->uploadedFile);

        $file = $this->fileFactory->createFileModel();
        $this->fillEntity($path, $file, $fileUploadDTO);
        $this->fileWriteRepository->save($file);

        return $file;
    }

    protected function storeFile(string $path, UploadedFile $uploadedFile): void
    {
        Storage::put($path, $uploadedFile);
    }

    protected function fillEntity(string $path, File $file, FileUploadDTO $fileUploadDTO): void
    {
        $file->setName($fileUploadDTO->uploadedFile->hashName());
        $file->setFileName($fileUploadDTO->uploadedFile->getClientOriginalName());
        $file->setMimeType($fileUploadDTO->uploadedFile->getClientMimeType());
        $file->setPath($path);
        $file->setSize($fileUploadDTO->uploadedFile->getSize());
    }
}
