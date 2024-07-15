<?php

namespace App\Domain\SignatureRequest\Factories;

use App\Domain\SignatureRequest\Entities\SignatureRequest;

class SignatureRequestFactory
{
    public function createSignatureRequestModel(): SignatureRequest
    {
        return new SignatureRequest();
    }
}
