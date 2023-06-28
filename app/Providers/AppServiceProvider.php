<?php

namespace App\Providers;

use App\Models\bills;
use App\Models\customers;
use App\Models\products;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        //danh cho tat ca cac view
        // view()->composer('*',function($view){
        //     $product=products::all()->count();
        //     $customer=customers::all()->count();
        //     $bill=bills::all()->count();

        //     return view($view,[
        //         'product'=>$product,
        //         'customer'=>$customer,
        //         'bill'=>$bill,
        //     ]);
        // });
            
    }
}
