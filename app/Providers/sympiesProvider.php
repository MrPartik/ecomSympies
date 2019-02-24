<?php

namespace App\Providers;

use App\r_currencies;
use App\t_setup;
use Illuminate\Support\ServiceProvider;
use vakata\database\Exception;

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

    public static  function isAvailable ($val){
        $start = "";
        $end = "";
        if(isset($val)){
            try{
                $dates = explode('to',$val);

                $start = strtotime(trim($dates[0]));
                $end = strtotime(trim($dates[1]));

                if(strtotime(date("m/d/Y")) >= $start && strtotime(date("m/d/Y")) <= $end)
                    return 1;
                return 0;


            }catch (Exception $e){
                return 0;
            }
        }
        return 1;

    }

    public static function filterAvailable($final){
        $Allprod = collect();
        foreach ($final as $item) {

            if (sympiesProvider::isAvailable($item->PROD_AVAILABILITY) == 1) {
                $Allprod->push($item);
            }

        }
        return $Allprod;
    }


    public static function active(){
        $active = t_setup::with('rCurrency')->orderByDesc('SET_ID')->first();

        return $active;
    }

    public static function active_currency(){

        return $current = r_currencies::with('rTaxTableProfile')->where('CURR_ID',sympiesProvider::active()->CURR_ID)->first();

    }

    public static function current_price($myprice){

        if($myprice) {
            return sympiesProvider::active_currency()->CURR_SYMBOL . ' ' . $myprice;
        }
        return '';
    }


    public static function format($collection){
        if($collection)
            foreach ($collection as $item){

                $discount = $item->PROD_DISCOUNT;
                $total= $item->PROD_MY_PRICE;

                $price = sympiesProvider::current_price(($total!='NAN')?number_format(($discount)?$total-($total*($discount/100)):$total,2):$total);
                $discount_price = sympiesProvider::current_price(($discount)?number_format($total,2):'');

                $item->PRICE = $price;
                $item->DISCOUNT = $discount_price;
            }

        return $collection;
    }



}
