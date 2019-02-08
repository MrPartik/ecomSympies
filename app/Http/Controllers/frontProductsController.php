<?php

namespace App\Http\Controllers;

use App\t_product_variance;
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

        if($id!=0)
            $Allprod = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('AFF_ID',$id)
            ->get()->take(9);
        else
            $Allprod = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
                ->where('PROD_IS_APPROVED','1')
                ->where('PROD_DISPLAY_STATUS',1)
                ->get()->take(9);

        return json_encode($Allprod);
    }


    public function getProdCategory($id){

        if($id!=0)
            $Allprod = r_product_info::with('rProductType','rAffiliateInfo','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('PRODT_ID',$id)
            ->get()->take(9);
        else
            $Allprod = r_product_info::with('rProductType','rAffiliateInfo','rTaxTableProfile')
                ->where('PROD_IS_APPROVED','1')
                ->where('PROD_DISPLAY_STATUS',1)
                ->get()->take(9);



        return json_encode($Allprod);
    }

    public function getProdDetails($id){

        $Allprod = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->get();


        $randProd = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->inRandomOrder()->get();

        $getProd = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('PROD_ID',$id)
            ->get();

        $getVar = t_product_variance::all()
            ->where('PROD_ID',$id);

        $aff = r_affiliate_info::all();
        $cat = r_product_type::with('rProductType')->get();

        return view('pages.frontend-shop.product-details',compact('Allprod','aff','cat','randProd','getProd','getVar','id'));
    }

}
