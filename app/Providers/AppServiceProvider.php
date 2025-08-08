<?php

namespace App\Providers;

use App\Models\Home;
use Illuminate\Support\Facades\URL;
use App\Models\Program;
use App\Models\Service;
use App\Models\SettingApp;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
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

        if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }
        //relasi morph pakai map
        Relation::morphMap([
            'service' => Service::class,
            'program' => Program::class,
        ]);


        View::composer('*', function ($view) {
            $programMenu = ['BAPTISM', 'WEDDING', 'BCM', 'KADERISASI', 'CSR'];
            $serviceMenu = [
                'IBADAH RAYA',
                'MOG',
                'DOA',
                'BOOM',
                'WBI',
                'RBI',
                'WN',
                'FA'
            ];
            $view
                ->with('setting', SettingApp::first())
                ->with('home', Home::first())
                ->with('programMenu', $programMenu)
                ->with('serviceMenu', $serviceMenu);
        });
    }
}
