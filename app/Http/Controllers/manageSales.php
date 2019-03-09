<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\r_product_info;
use App\t_order_item;
use App\t_order;
use Illuminate\Support\Facades\Auth;

class manageSales extends Controller
{
    //
    public function sales(){


        $prodInfo = r_product_info::all();
        (Auth::user()->role=='admin')?'':$prodInfo=$prodInfo->where('AFF_ID',Auth::user()->AFF_ID);

        $prodInfo = r_product_info::all();
        (Auth::user()->role=='admin')?'':$prodInfo=$prodInfo->where('AFF_ID',Auth::user()->AFF_ID);

        $order_item = t_order_item::with('tOrder','rProductInfo')
            ->get();
        $order_item = $order_item->whereIn('PROD_ID',$prodInfo->pluck('PROD_ID')->toArray());

        $order = t_order::all();
        $order = $order->whereIn('ORD_ID',$order_item->pluck('ORD_ID')->toArray());



        $customer = collect(DB::SELECT("
        SELECT  ORD.ORD_FROM_NAME FROM_NAME
        ,SUM(ORDI.ORDI_QTY) QUANTITY
        ,SUM(PAY.PAY_AMOUNT_DUE) GROSS_SALES
        ,SUM(ORDI.PROD_MY_PRICE*(ORD.ORD_DISCOUNT/100)) DISCOUNT
        ,SUM(PAY.PAY_SUB_TOTAL) NET_SALES 
        ,SUM(PAY.PAY_SALES_TAX) VAT_SALES
        ,SUM(PAY.PAY_DELIVERY_CHARGE) DELIVERY
        FROM t_orders ORD
        INNER JOIN t_invoices INV  ON INV.ORD_ID = ORD.ORD_ID
        INNER JOIN t_order_items ORDI ON ORD.ORD_ID = ORDI.ORD_ID
        INNER JOIN t_payments PAY ON INV.INV_ID = PAY.INV_ID
        WHERE ORD.ORD_STATUS ='Completed'
        GROUP BY ORD.ORD_FROM_NAME
        "));
        $customer = $customer->whereIn('FROM_NAME',$order->pluck('ORD_FROM_NAME')->toArray());

        $stock = collect(DB::SELECT("
        SELECT ORDI.PROD_SKU SKU
	    ,ORDI.PROD_NAME PROD_NAME
        ,SUM(ORDI.ORDI_QTY) QUANTITY
        ,SUM(ORDI.PROD_MY_PRICE*(ORD.ORD_DISCOUNT/100)) DISCOUNT
        ,SUM(PAY.PAY_AMOUNT_DUE) GROSS_SALES
        ,SUM(PAY.PAY_SUB_TOTAL) NET_SALES
        ,SUM(PAY.PAY_SALES_TAX) VAT_SALES
        ,SUM(PAY.PAY_DELIVERY_CHARGE) DELIVERY
        FROM t_orders ORD
        INNER JOIN t_invoices INV  ON INV.ORD_ID = ORD.ORD_ID
        INNER JOIN t_order_items ORDI ON ORD.ORD_ID = ORDI.ORD_ID
        INNER JOIN t_payments PAY ON INV.INV_ID = PAY.INV_ID
        WHERE ORD.ORD_STATUS ='Completed'
        GROUP BY ORDI.PROD_SKU,ORDI.PROD_NAME
        "));
        $stock = $stock->whereIn('SKU',$order_item->pluck('PROD_SKU')->toArray());

        return view('pages.sales.sales',compact('customer','stock'));

    }



}