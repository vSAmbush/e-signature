<?php

namespace App\Domain\SignatureRequest\Enums;

enum SignatureRequestStatusEnum: int
{
    case PENDING = 0;
    case SIGNED = 1;
}
