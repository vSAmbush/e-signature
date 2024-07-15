<?php

namespace App\Domain\Document\Factories;

use App\Domain\Document\Entities\Document;

class DocumentFactory
{
    public function createDocument(): Document
    {
        return new Document();
    }
}
