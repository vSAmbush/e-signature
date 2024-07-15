<?php

namespace App\Domain\Document\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\Entities\Document;

class EloquentDocumentWriteRepository implements DocumentWriteRepositoryInterface
{
    public function save(Document $document): void
    {
        $isSaved = $document->save();

        if (! $isSaved) {
            throw new EntityNotSavedException('Document has not been saved');
        }
    }
}
