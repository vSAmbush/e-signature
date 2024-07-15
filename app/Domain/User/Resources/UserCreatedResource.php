<?php

namespace App\Domain\User\Resources;

use App\Domain\User\Entities\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCreatedResource extends JsonResource
{
    /** @var User $resource */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getId(),
        ];
    }
}
