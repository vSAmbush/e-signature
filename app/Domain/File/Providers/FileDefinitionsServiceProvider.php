<?php

namespace App\Domain\File\Providers;

use App\Domain\File\Repositories\EloquentFileWriteRepository;
use App\Domain\File\Repositories\FileWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class FileDefinitionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            FileWriteRepositoryInterface::class,
            EloquentFileWriteRepository::class
        );
    }
}
