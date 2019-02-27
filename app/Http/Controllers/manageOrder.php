<?php

namespace App\Http\Controllers;

use App\t_order;
use App\t_order_item;
use Illuminate\Http\Request;

class manageOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function filter(){

        $status = '';
        if(\Request::is('order-pending'))
            $status='pending';
        else if(\Request::is('order-cancel'))
            $status='cancel';
        else if(\Request::is('order-complete'))
            $status='completed';
        else if(\Request::is('order-refund'))
            $status='refund';
        else if(\Request::is('order-void'))
            $status='void';



        $order = t_order::where('ORD_STATUS',$status)
            ->get();
        $order_item = t_order_item::with('tOrder','rProductInfo')
            ->get();

        return view('pages.orders.table-orders',compact('status','order','order_item'));
    }

}
