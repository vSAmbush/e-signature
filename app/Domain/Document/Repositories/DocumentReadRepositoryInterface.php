<?php

namespace App\Domain\Document\Repositories;

use App\Domain\Document\Entities\Document;

interface DocumentReadRepositoryInterface
{
    public function findDocumentById(int $id): Document|null;
    public function isDocumentExistsByIdAndStatus(int $id, int $status): bool;
    public function isDocumentExistsByOwnerId(int $ownerId): bool;
}
