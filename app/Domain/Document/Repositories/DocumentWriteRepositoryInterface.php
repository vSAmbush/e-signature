<?php

namespace App\Domain\Document\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\Document\Entities\Document;

interface DocumentWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(Document $document);
}
