<?php

namespace App\Domain\Document\Providers;

use App\Domain\Document\Repositories\DocumentReadRepositoryInterface;
use App\Domain\Document\Repositories\DocumentWriteRepositoryInterface;
use App\Domain\Document\Repositories\EloquentDocumentReadRepository;
use App\Domain\Document\Repositories\EloquentDocumentWriteRepository;
use Illuminate\Support\ServiceProvider;

class DocumentDefinitionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            DocumentWriteRepositoryInterface::class,
            EloquentDocumentWriteRepository::class
        );
        $this->app->bind(
            DocumentReadRepositoryInterface::class,
            EloquentDocumentReadRepository::class
        );
    }
}
