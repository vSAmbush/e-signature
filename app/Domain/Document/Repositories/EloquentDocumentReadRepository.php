<?php

namespace App\Domain\Document\Repositories;

use App\Domain\Document\Entities\Document;

class EloquentDocumentReadRepository implements DocumentReadRepositoryInterface
{
    public function findDocumentById(int $id): Document|null
    {
        /** @var Document|null */
        return Document::query()->where('id', $id)->first();
    }

    public function isDocumentExistsByIdAndStatus(int $id, int $status): bool
    {
        return Document::query()->where('id', $id)->where('status', $status)->exists();
    }

    public function isDocumentExistsByOwnerId(int $ownerId): bool
    {
        return Document::query()->where('owner_id', $ownerId)->exists();
    }
}
