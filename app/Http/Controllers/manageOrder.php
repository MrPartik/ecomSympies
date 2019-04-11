<?php

namespace App\Http\Controllers;

use App\r_product_info;
use App\t_invoice;
use App\t_order;
use App\t_order_item;
use App\t_payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use vakata\database\Exception;

class manageOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodInfo = r_product_info::all();
        (Auth::user()->role=='admin')?'':$prodInfo=$prodInfo->where('AFF_ID',Auth::user()->AFF_ID);

        $order_item = t_order_item::with('tOrder','rProductInfo')
            ->get();
        $order_item = $order_item->whereIn('PROD_ID',$prodInfo->pluck('PROD_ID')->toArray());

        $order = t_order::all();
        $order = $order->whereIn('ORD_ID',$order_item->pluck('ORD_ID')->toArray());

        return view('pages.orders.table-orders',compact('order','order_item'));

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
        $type =$request->type;
        $id = $request->id;
        $ids=$request->ids;

            if($type==1){
                foreach($ids as $id){
                    $order = t_order::where('ORD_ID',$id)->first();
                    $order->ORD_STATUS = 'Completed';
                    $order->ORD_COMPLETE = Carbon::now();
                    $order->ORD_CANCELLED = NULL;
                    $order->updated_at = Carbon::now();
                    $order->save();

                    $inv = t_invoice::where('ORD_ID',$id)->first();
                    $inv->INV_STATUS = 'Completed';
                    $inv->updated_at = Carbon::now();
                    $inv->save();

                    $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                    $pay->PAY_CAPTURED_AT = Carbon::now();
                    $pay->updated_at = Carbon::now();
                    $pay->save();
                }
            }else if($type==2){
                foreach($ids as $id){
                    $order = t_order::where('ORD_ID',$id)->first();
                    $order->ORD_STATUS = 'Void';
                    $order->ORD_COMPLETE = NULL;
                    $order->ORD_CANCELLED = NULL;
                    $order->updated_at = Carbon::now();
                    $order->save();

                    $inv = t_invoice::where('ORD_ID',$id)->first();
                    $inv->INV_STATUS = 'Void';
                    $inv->updated_at = Carbon::now();
                    $inv->save();

                    $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                    $pay->PAY_CAPTURED_AT = NULL;
                    $pay->updated_at = Carbon::now();
                    $pay->save();

                }
            }else if($type==3){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Refunded';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Refunded';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();
            }else if($type==4){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Void';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Void';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==5){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Completed';
                $order->ORD_COMPLETE = Carbon::now();
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();


                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Completed';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = Carbon::now();
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==6){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Cancelled';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = Carbon::now();
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Cancelled';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==6.1){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Pending';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();


                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Pending';
                $inv->updated_at = Carbon::now();
                $inv->save();


            }else if($type==3.1){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Pending';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now()  ;
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Pending';
                $inv->updated_at = Carbon::now();
                $inv->save();

            }

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
