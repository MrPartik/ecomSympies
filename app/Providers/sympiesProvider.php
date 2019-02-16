<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class sympiesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static function SellingPrice($approved,$rebate,$base,$taxType,$taxRate,$markup){

        return ($approved==1)?(($rebate/100)* $base)
            +(($taxType==0)?($taxRate/100)* $base:($taxRate)+ $base)
            +(($markup/100)* $base)+$base:'NAN';

    }
}
