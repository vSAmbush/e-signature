<?php

namespace App\Domain\SignatureRequest\Providers;

use App\Domain\SignatureRequest\Repositories\EloquentSignatureRequestReadRepository;
use App\Domain\SignatureRequest\Repositories\EloquentSignatureRequestWriteRepository;
use App\Domain\SignatureRequest\Repositories\SignatureRequestReadRepositoryInterface;
use App\Domain\SignatureRequest\Repositories\SignatureRequestWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SignatureRequestDefinitionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            SignatureRequestWriteRepositoryInterface::class,
            EloquentSignatureRequestWriteRepository::class
        );
        $this->app->bind(
            SignatureRequestReadRepositoryInterface::class,
            EloquentSignatureRequestReadRepository::class
        );
    }
}
