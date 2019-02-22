
@extends('layouts.frontend-main')

@section('title','Product Details')

@section('content')
    <!-- BEGIN #product -->
    <div id="product" class="section-container p-t-20">
        <!-- BEGIN container -->
        <div class="container">

        @foreach($getProd as $item)
            @php
                $total=$item->PROD_MY_PRICE;
            @endphp
            <!-- BEGIN product -->
            <div class="product">
                <!-- BEGIN product-detail -->
                <div class="product-detail">
                    <!-- BEGIN product-image -->
                    <div class="product-image">
                        <!-- BEGIN product-thumbnail -->
                        <div class="product-thumbnail">
                            <ul class="product-thumbnail-list">
                                <li class="active" data-toggle="tooltip" title="{{$item->PROD_NAME}}">
                                    <a href="#" data-click="show-main-image" data-url="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}">
                                        <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" />
                                    </a>
                                </li>
                                @foreach($getVar as $var)
                                    <li class="" data-toggle="tooltip" title="{{$var->PRODV_NAME}}">
                                        <a href="#" data-click="show-main-image" data-url="{{($var->PRODV_IMG==null||!file_exists($var->PRODV_IMG))?asset('uPackage.png'):asset($var->PRODV_IMG)}}">
                                            <img src="{{($var->PRODV_IMG==null||!file_exists($var->PRODV_IMG))?asset('uPackage.png'):asset($var->PRODV_IMG)}}" alt="{{$var->PRODV_NAME}}" alt="" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- END product-thumbnail -->
                        <!-- BEGIN product-main-image -->
                        <div class="product-main-image" data-id="main-image">
                            <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" alt="" />

                        </div>
                        <!-- END product-main-image -->
                    </div>
                    <!-- END product-image -->
                    <!-- BEGIN product-info -->
                    <div class="product-info">
                        <!-- BEGIN product-info-header -->
                        <div class="product-info-header">
                            <h1 class="product-title"><span class="label label-success">{{$discount = $item->PROD_DISCOUNT}}% OFF</span> {{$item->PROD_NAME}} </h1>
                            <ul class="product-category">

                                <li>
                                    <a href="#">
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->rProductType->PRODT_TITLE ?? 'Not set'}}
                                    </a>
                                </li>
                                <li>/</li>
                                <li>
                                    <a href="#">
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->PRODT_TITLE ?? 'Not set'}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END product-info-header -->
                        <!-- BEGIN product-warranty -->
                        <div class="product-warranty">
                            <div class="pull-right">Availability: In stock</div>
                            <div><b>{{$item->rAffiliateInfo->AFF_NAME}}</b></div>
                        </div>
                        <!-- END product-warranty -->
                        <!-- BEGIN product-info-list -->
                        <span class="description">{{$item->PROD_DESC}}</span><br><br>
                        <ul class="product-info-list">

                            <li>
                                <i class="fa fa-circle"></i> {{$item->PROD_NAME }} - default
                            </li>
                            @foreach($getVar as $var)
                                <li>
                                    <i class="fa fa-circle"></i> {{$var->PRODV_NAME }} - {{\App\Providers\sympiesProvider::current_price(number_format((($discount)?$total-($total*($discount/100)):$total)+($var->PRODV_ADD_PRICE),2) ) }}
                                </li>
                            @endforeach
                        </ul>
                        <!-- END product-info-list -->
                        <!-- BEGIN product-social -->
                        <div class="product-social">
                            <ul>
                                <li><a href="javascript:;" class="facebook" data-toggle="tooltip" data-trigger="hover" data-title="Facebook" data-placement="top"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:;" class="twitter" data-toggle="tooltip" data-trigger="hover" data-title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:;" class="google-plus" data-toggle="tooltip" data-trigger="hover" data-title="Google Plus" data-placement="top"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:;" class="whatsapp" data-toggle="tooltip" data-trigger="hover" data-title="Whatsapp" data-placement="top"><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href="javascript:;" class="tumblr" data-toggle="tooltip" data-trigger="hover" data-title="Tumblr" data-placement="top"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div>
                        <!-- END product-social -->
                        <!-- BEGIN product-purchase-container -->
                        <div class="product-purchase-container">

                            <div class="product-discount">
                                <span class="discount">{{$item->DISCOUNT}}</span>
                            </div>
                            <div class="product-price">
                                <div class="price">{{$item->PRICE}}</div>
                            </div>
                            <a href="#buy"  id="buyProd" class="btn btn-success" data-toggle="modal" tooltip="tooltip" title= "Click to Buy"><i class="fa fa-credit-card-alt"></i> Buy</a>
                            <form  method="POST" method="POST" id="payment-form" action="{!! URL::to('paypal') !!}" _target="blank">
                                {{ csrf_field() }}
                                <input name="ProdName" value="{{$item->PROD_NAME}}" style="display: none">
                                <input name="prodID" value="{{$item->PROD_ID}}" style="display: none">


                                {{--<!-- PayPal Logo -->--}}
                                    {{--<table border="0" cellpadding="10" cellspacing="0" align="left">--}}
                                        {{--<tr>--}}
                                            {{--<td align="center"></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td align="center">--}}
                                                {{--<a  href="javascript:;" onclick="document.getElementById('payment-form').submit();"  title="Pay using paypal"  >--}}
                                                    {{--<img src="https://www.paypalobjects.com/webstatic/mktg/logo/PP_AcceptanceMarkTray-NoDiscover_243x40.png" alt="Buy now with PayPal" />--}}
                                                {{--</a>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--</table>--}}
                                {{--<!-- PayPal Logo -->--}}
                            </form>
                            <center>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <!-- Container for PayPal Mark Checkout -->
                                    <div id="paypalCheckoutContainer"></div>
                                </div>
                            </div>
                            </center>
                        </div>
                        <!-- END product-purchase-container -->
                    </div>
                    <!-- END product-info -->
                </div>
                <!-- END product-detail -->
                <!-- BEGIN product-tab -->
                <div class="product-tab">
                    <!-- BEGIN #product-tab -->
                    <ul id="product-tab" class="nav nav-tabs">
                        <li class="active"><a href="#product-desc" data-toggle="tab">Product Description</a></li>
                    </ul>
                    <!-- END #product-tab -->
                    <!-- BEGIN #product-tab-content -->
                    <div id="product-tab-content" class="tab-content">
                        <!-- BEGIN #product-desc -->
                        <div class="tab-pane fade active in" id="product-desc">
                          @php echo $item->PROD_NOTE @endphp
                        </div>
                        <!-- END #product-desc -->

                    </div>
                    <!-- END #product-tab-content -->
                </div>
                <!-- END product-tab -->
            </div>
            <!-- END product -->

                <div class="modal modal-message fade" id="buy" >
                    <div class="modal-dialog" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> </img>iGift</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form id="prodOrderNow" method="post" action="{{url('product/discount')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input id="DiscountProdID" name="prodID" value="0" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-bottom: 20px;">
                                            <strong>You are about to checkout this item.</strong>
                                            <p>Please indicate how many items you want to checkout.</p>
                                        </div>
                                    </div>
                                    <!-- BEGIN checkout-body -->
                                    <div class="checkout-body">
                                        <div class="table-responsive">
                                            <table class="table table-cart">
                                                <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="cart-product">
                                                        <div class="product-img">
                                                            <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" alt="" />
                                                        </div>
                                                        <div class="product-info">
                                                            <div class="title">
                                                                @if(count($getVar))
                                                                    <select class="form-control" id="prodVars" name="prodVars" style="width: 100%;" required>
                                                                        <option price="{{$item->PROD_MY_PRICE}}" prodid="{{$item->PROD_ID}}" prodvar="">{{$item->PROD_NAME}}</option>
                                                                        @foreach($getVar as $var)
                                                                            <option price="{{(($discount)?$total-($total*($discount/100)):$total)+($var->PRODV_ADD_PRICE) }}" prodid="" prodvar="{{$var->PRODV_ID}}">{{$var->PRODV_NAME}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    {{$item->PROD_NAME}}
                                                                @endif
                                                            </div>
                                                            <div class="desc">Delivers Tue 26/04/2016 - Free</div>
                                                        </div>
                                                    </td>
                                                    <td class="cart-price text-center">$999.00</td>
                                                    <td class="cart-qty text-center">
                                                        <div class="cart-qty-input">
                                                            <a href="#" class="qty-control left disabled" data-click="decrease-qty" data-target="#qty"><i class="fa fa-minus"></i></a>
                                                            <input type="text" name="qty" value="1" class="form-control" id="qty" />
                                                            <a href="#" class="qty-control right disabled" data-click="increase-qty" data-target="#qty"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                        <div class="qty-desc">1 to max order</div>
                                                    </td>
                                                    <td class="cart-total text-center">
                                                        $999.00
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart-summary" colspan="4">
                                                        <div class="summary-container">
                                                            <div class="summary-row">
                                                                <div class="field">Cart Subtotal</div>
                                                                <div class="value">$999.00</div>
                                                            </div>
                                                            <div class="summary-row text-danger">
                                                                <div class="field">Free Shipping</div>
                                                                <div class="value">$0.00</div>
                                                            </div>
                                                            <div class="summary-row total">
                                                                <div class="field">Total</div>
                                                                <div class="value">$999.00</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END checkout-body -->
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- BEGIN similar-product -->
            <h4 class="m-b-15 m-t-30">You Might Also Like</h4>
            <div class="row row-space-10">

            @foreach($randProd->take(6) as $item)
                <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="{{url('product/details/'.$item->PROD_ID)}}" class="item-image">
                                <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                <div class="discount" >{{$discount=$item->PROD_DISCOUNT}}% OFF</div>
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="{{url('product/details/'.$item->PROD_ID)}}">{{$item->PROD_NAME}}<br />
                                        <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                    </a>
                                </h4>
                                <p class="item-desc" title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                <div class="item-price">
                                    {{$item->PRICE}}
                                </div>
                                <div class="item-discount-price">
                                    {{$item->DISCOUNT}}
                                </div>
                            </div>
                        </div>
                        <!-- END item -->
                    </div>
                    <!-- END col-2 -->
                @endforeach

            </div>
            <!-- END similar-product -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #product -->

@endsection
@section('extrajs')
    <script>
        $('select').select2({ dropdownParent: $('#prodOrderNow')});
    </script>
@endsection

