<?php

namespace App\Domain\File\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\File\Entities\File;

interface FileWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(File $file);
}
