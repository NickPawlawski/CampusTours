<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function boot()
    {
        Schema::defaultStringLength(191);

        // Custom validator for filtering by date
        Validator::extend('date_or_empty', function($attribute, $value, $parameters, $validator) {
            if (empty($value)) {
                return true;
            } else {
                return date('Y-m-d', strtotime($value)) == $value;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        
    }
}
