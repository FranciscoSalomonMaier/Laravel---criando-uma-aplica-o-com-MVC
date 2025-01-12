<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;

class SeriesRepositoryProvider extends ServiceProvider
{

    //Outro modo de aplicar o Service Provider
    // public array $bindings = [
    //     SeriesRepository::class => EloquentSeriesRepository::class
    // ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
