<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\StudentRepository::class, \App\Repositories\StudentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PeopleRepository::class, \App\Repositories\PeopleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdressRepository::class, \App\Repositories\AdressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CityRepository::class, \App\Repositories\CityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StateRepository::class, \App\Repositories\StateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TeacherRepository::class, \App\Repositories\TeacherRepositoryEloquent::class);
        //:end-bindings:
    }
}
