<?php

namespace App\Domain\SignatureRequest\Controllers;

use App\Domain\Base\Exception\BaseException;
use App\Domain\SignatureRequest\Requests\SignatureRequestCreateRequest;
use App\Domain\SignatureRequest\Resources\SignatureRequestCreatedResource;
use App\Domain\SignatureRequest\Services\SignatureRequestCreateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class SignatureRequestController extends Controller
{
    public function __construct(
        protected readonly SignatureRequestCreateService $signatureRequestCreateService
    ) {
    }

    public function create(SignatureRequestCreateRequest $signatureRequestCreateRequest): JsonResponse
    {
        $dto = $signatureRequestCreateRequest->toDTO();

        try {
            $signatureRequest = $this->signatureRequestCreateService->createSignatureRequest($dto);
        } catch (BaseException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ], 400);
        }

        return (new SignatureRequestCreatedResource($signatureRequest))->response()->setStatusCode(201);
    }
}
