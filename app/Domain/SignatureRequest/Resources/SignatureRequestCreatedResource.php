<?php

namespace App\Domain\SignatureRequest\Resources;

use App\Domain\SignatureRequest\Entities\SignatureRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SignatureRequestCreatedResource extends JsonResource
{
    /** @var SignatureRequest $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
        ];
    }
}
