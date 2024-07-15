<?php

namespace App\Domain\File\Controllers;

use App\Domain\Base\Exception\BaseException;
use App\Domain\File\Requests\FileUploadRequest;
use App\Domain\File\Resources\FileUploadedResource;
use App\Domain\File\Services\FileUploadService;
use Illuminate\Http\JsonResponse;

class FileController
{
    public function __construct(
        protected readonly FileUploadService $fileUploadService
    ) {
    }

    public function uploadDocument(FileUploadRequest $uploadFileRequest): FileUploadedResource|JsonResponse
    {
        $dto = $uploadFileRequest->toDTO();
        $path = sprintf('documents/%s', $dto->username);

        try {
            $file = $this->fileUploadService->saveFile($path, $dto);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ], 400);
        }

        return (new FileUploadedResource($file));
    }
}
