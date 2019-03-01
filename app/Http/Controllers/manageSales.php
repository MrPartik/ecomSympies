<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class manageSales extends Controller
{
    //
    public function sales(){

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

        return view('pages.sales.sales',compact('customer','stock'));

    }



}
