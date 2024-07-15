<?php

namespace App\Domain\File\Resources;

use App\Domain\File\Entities\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileUploadedResource extends JsonResource
{
    /** @var File $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
            'name' => $this->resource->getName(),
            'file_name' => $this->resource->getFileName(),
        ];
    }
}
