<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\r_product_info;
use App\r_affiliate_info;   
use App\r_product_type;


class frontProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Allprod = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)->get();
        $aff = r_affiliate_info::all();
        $cat = r_product_type::with('rProductType')->get();
        
        
        return view('pages.frontend-shop.list-front-products',compact('Allprod','aff','cat'));
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


    public function getProdAffiliates($id){
        $Allprod = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('AFF_ID',$id)
            ->get()->take(9);

        return json_encode($Allprod);
    }


    public function getProdCategory($id){
        $Allprod = r_product_info::with('rProductType','rAffiliateInfo','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('PRODT_ID',$id)
            ->get(['PRODT_ID'])->take(9);

        $prod = r_product_type::with('rProductType')
            ->whereIn('PRODT_ID',$Allprod)
            ->where('PRODT_PARENT','<>',null)
            ->get();

        return json_encode($Allprod);
    }
}
