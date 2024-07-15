<?php

namespace App\Domain\SignatureRequest\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\SignatureRequest\Entities\SignatureRequest;

class EloquentSignatureRequestWriteRepository implements SignatureRequestWriteRepositoryInterface
{
    public function save(SignatureRequest $signatureRequest): void
    {
        $isSaved = $signatureRequest->save();

        if (! $isSaved) {
            throw new EntityNotSavedException('Signature request has not been saved');
        }
    }
}
