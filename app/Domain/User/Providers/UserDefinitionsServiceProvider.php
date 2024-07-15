<?php

namespace App\Domain\User\Providers;

use App\Domain\User\Repositories\EloquentUserReadRepository;
use App\Domain\User\Repositories\EloquentUserWriteRepository;
use App\Domain\User\Repositories\UserReadRepositoryInterface;
use App\Domain\User\Repositories\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserDefinitionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserReadRepositoryInterface::class, EloquentUserReadRepository::class);
        $this->app->bind(UserWriteRepositoryInterface::class, EloquentUserWriteRepository::class);
    }
}
