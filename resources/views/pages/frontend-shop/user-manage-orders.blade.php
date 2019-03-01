@extends('layouts.frontend-main')

@section('title','Manage Orders')

@section('content')


    <!-- BEGIN #faq -->
    <div id="faq" class="section-container">
        <!-- BEGIN container -->
        <div class="container">

            <!-- BEGIN panel-group -->
            <div class="panel-group faq" id="faq-list">
                    @foreach($order->where('SYMPIES_ID',Session::get('sympiesAccount')['ID']) as $item)
                        @php

                            $status = ucwords($item->ORD_STATUS);
                            $color = '';

                            if($status=='Completed') $color ='#cdfbcd';
                            elseif($status=='Pending') $color ='#ffe4b1';
                            elseif($status=='Request Refund') $color ='#ffe4b1';
                            elseif($status=='Request Cancellation') $color ='#ffe4b1';
                            elseif($status=='Cancelled') $color ='#ff8490';
                            elseif($status=='Void') $color ='#ff8490';
                            elseif($status=='Refunded') $color ='#ff8490';

                        @endphp
                        <!-- BEGIN panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading" style="background: {{$color}}; color:black">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#order-{{$item->ORD_ID}}">
                                        <i class="fa fa-truck"></i>
                                        {{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }} - {{$item->ORD_TO_EMAIL}}, {{$item->ORD_SYMP_TRANS_CODE}}  - {{ucwords($item->ORD_STATUS)}}
                                    </a>
                                </h4>
                            </div>
                            <div id="order-{{$item->ORD_ID}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @foreach($order_item->where('ORD_ID',$item->ORD_ID) as $ord_item )
                                        <div class="row">
                                            <div class="col-md-4">
                                                <center>
                                                    <a href="{{(!file_exists('uploads/'.$ord_item->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$ord_item->PROD_SKU.'.jpg')}}" data-lightbox="gallery-group-1">
                                                        <img style="width: 50%;height: 100%;" src="{{(!file_exists('uploads/'.$ord_item->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$ord_item->PROD_SKU.'.jpg')}}">
                                                    </a>
                                                </center>
                                                <br>
                                            </div>
                                            <div class="col-md-8">

                                                SKU: {{$ord_item->PROD_SKU}}<br>
                                                Name: {{$ord_item->PROD_NAME}}<br>
                                                Description: {{$ord_item->PROD_DESC}}<br>
                                                Quantity: {{$ord_item->ORDI_QTY}}<br>
                                                Product Name: {{$ord_item->PROD_NAME}}<br>
                                                Price: {{Sympies::current_price(number_format($ord_item->ORDI_SOLD_PRICE,2))}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- END panel -->
                    @endforeach

            </div>
            <!-- END panel-group -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #faq -->

@endsection

@section('extrajs')

@endsection
