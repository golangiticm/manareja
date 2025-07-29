<?php

namespace App\Providers;

use App\Models\Program;
use App\Models\Service;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //relasi morph pakai map
        Relation::morphMap([
            'service' => Service::class,
            'program' => Program::class,
        ]);
    }
}
