<?php

namespace App\Domain\File\Repositories;

use App\Domain\Base\Exception\EntityNotSavedException;
use App\Domain\File\Entities\File;

class EloquentFileWriteRepository implements FileWriteRepositoryInterface
{
    /**
     * @throws EntityNotSavedException
     */
    public function save(File $file): void
    {
        $isSaved = $file->save();

        if (! $isSaved) {
            throw new EntityNotSavedException('File has not been saved');
        }
    }
}
