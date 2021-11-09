<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Maincategory;
use App\Models\Subcategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'layouts.main', function ($view){
                $view->with('maincategory',Maincategory::all())->with('subcategory',Subcategory::all());
            }
        );
       
    }
}
