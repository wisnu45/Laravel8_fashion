<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }


    public function boot()
    {
     
        View::composer('frontend.header', MenuComposer::class);
        View::composer('frontend.cart',CartComposer::class);

      
    }
}