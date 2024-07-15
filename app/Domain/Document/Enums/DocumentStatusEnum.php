<?php

namespace App\Domain\Document\Enums;

enum DocumentStatusEnum: int
{
    case NEW = 0;
    case ON_SIGNING = 1;
    case SIGNED = 2;
}
