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
        $this->app->bind(\App\Repositories\ClassRepository::class, \App\Repositories\ClassRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CourseRepository::class, \App\Repositories\CourseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ModuleRepository::class, \App\Repositories\ModuleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\QuestionRepository::class, \App\Repositories\QuestionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AnswerRepository::class, \App\Repositories\AnswerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GroupRepository::class, \App\Repositories\GroupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GroupPermissionRepository::class, \App\Repositories\GroupPermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GroupTeacherRepository::class, \App\Repositories\GroupTeacherRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SaleRepository::class, \App\Repositories\SaleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ItemSaleRepository::class, \App\Repositories\ItemSaleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PromotionRepository::class, \App\Repositories\PromotionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        //:end-bindings:
    }
}
