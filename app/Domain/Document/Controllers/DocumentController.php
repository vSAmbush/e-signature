<?php

namespace App\Domain\Document\Controllers;

use App\Domain\Base\Exception\BaseException;
use App\Domain\Document\Requests\DocumentAddRequest;
use App\Domain\Document\Requests\DocumentSignRequest;
use App\Domain\Document\Resources\DocumentAddedResource;
use App\Domain\Document\Services\DocumentAddService;
use App\Domain\Document\Services\DocumentSignService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DocumentController extends Controller
{
    public function __construct(
        protected readonly DocumentAddService $documentAddService,
        protected readonly DocumentSignService $documentSignService
    ) {
    }

    public function add(DocumentAddRequest $addDocumentRequest): JsonResponse
    {
        $dto = $addDocumentRequest->toDTO();

        try {
            $document = $this->documentAddService->addDocument($dto);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ], 400);
        }

        return (new DocumentAddedResource($document))->response()->setStatusCode(201);
    }

    public function sign(DocumentSignRequest $documentSignRequest): Response|JsonResponse
    {
        $dto = $documentSignRequest->toDTO();

        try {
            $this->documentSignService->singDocument($dto);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ], 400);
        }

        return response()->noContent();
    }
}
