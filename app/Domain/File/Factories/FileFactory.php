<?php

namespace App\Domain\File\Factories;

use App\Domain\File\Entities\File;

class FileFactory
{
    public function createFileModel(): File
    {
        return new File();
    }
}
