<?php

namespace App\Domain\Document\Resources;

use App\Domain\Document\Entities\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentAddedResource extends JsonResource
{
    /** @var Document $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
            'title' => $this->resource->getTitle(),
        ];
    }
}
