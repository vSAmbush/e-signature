<?php

namespace App\Domain\SignatureRequest\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\SignatureRequest\Entities\SignatureRequest;

interface SignatureRequestWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(SignatureRequest $signatureRequest);
}
