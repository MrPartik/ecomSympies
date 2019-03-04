<?php

namespace App\Http\Controllers;

use App\r_inventory_info;
use App\r_product_info;
use App\t_product_variance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;


class manageInventory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = collect(DB::SELECT("SELECT 
			PROD.PROD_ID
			,PROD.PROD_NAME 
			,PROD.PROD_DESC
			,PROD.PROD_CODE
			,PROD.PROD_IMG
			,PROD.PROD_CRITICAL 
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
					+(SELECT IFNULL(SUM(QPROD.PROD_INIT_QTY),0) FROM r_product_infos QPROD WHERE QPROD.PROD_ID = PROD.PROD_ID)) CAPITAL
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID) DISPOSED
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID) 'ORDER'
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='CAPITAL' AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_produc
					t_infos WHERE PROD_ID = PROD.PROD_ID)) TOTAL
					FROM r_product_infos PROD
					"));

        return view('pages.inventory.table-inventory-remaining',compact('inventory'));

    }

    public function manageInventory(Request $request){

        return view('pages.inventory.manage-inventory');
    }

    public function skuInventory($sku,Request $request){
        try {
            $prod = r_product_info::where('PROD_CODE', $sku)->first();
            $prodvar = collect(DB::SELECT("
        SELECT 
			PRODV.PRODV_ID
			,PRODV.PRODV_NAME
			,PRODV.PRODV_DESC
			,PRODV.PRODV_IMG
			,PRODV.PRODV_INIT_QTY
			,PRODV.PRODV_ADD_PRICE
			,PRODV.PRODV_SKU
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT IFNULL(SUM(QPRODV.PRODV_INIT_QTY),0) FROM t_product_variances QPRODV WHERE QPRODV.PROD_ID = PRODV.PROD_ID AND QPRODV.PRODV_ID = PRODV.PRODV_ID)) CAPITAL
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID) DISPOSED
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID) 'ORDER'
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='CAPITAL' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT IFNULL(SUM(QPRODV.PRODV_INIT_QTY),0) FROM t_product_variances QPRODV WHERE QPRODV.PROD_ID = PRODV.PROD_ID AND QPRODV.PRODV_ID = PRODV.PRODV_ID)) TOTAL  
            FROM t_product_variances PRODV WHERE PRODV.PROD_ID = $prod->PROD_ID "));
        }catch(\Exception $e){
            return abort('404');
        }

        return view('pages.inventory.sku-inventory',compact('prod','prodvar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
