
@extends('layouts.frontend-main')

@section('title','Product Details')

@section('content')
    <!-- BEGIN #product -->
    <div id="product" class="section-container p-t-20">
        <!-- BEGIN container -->
        <div class="container">

        @foreach($getProd as $item)
            <!-- BEGIN product -->
            <div class="product">
                <!-- BEGIN product-detail -->
                <div class="product-detail">
                    <!-- BEGIN product-image -->
                    <div class="product-image">
                        <!-- BEGIN product-thumbnail -->
                        <div class="product-thumbnail">
                            <ul class="product-thumbnail-list">
                                <li class="active">
                                    <a href="#" data-click="show-main-image" data-url="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}">
                                        <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" />
                                    </a>
                                </li>
                                @foreach($getVar as $var)

                                    <li class="">
                                        <a href="#" data-click="show-main-image" data-url="">
                                            <img src="" alt="{{$var->PRODV_NAME}}" />
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
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->rProductType->PRODT_TITLE}}
                                    </a>
                                </li>
                                <li>/</li>
                                <li>
                                    <a href="#">
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->PRODT_TITLE}}
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
                                    <i class="fa fa-circle"></i> {{$var->PRODV_NAME }}
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
                            @php
                                $total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN';
                            @endphp
                            <div class="product-discount">
                                <span class="discount">{{($discount)?number_format($total,2):''}}</span>
                            </div>
                            <div class="product-price">
                                <div class="price">{{number_format(($discount)?$total-($total*($discount/100)):$total,2)}}</div>
                            </div>
                            <form  method="POST" method="POST" id="payment-form" action="{!! URL::to('paypal') !!}" _target="blank">
                                {{ csrf_field() }}
                                <input name="ProdName" value="{{$item->PROD_NAME}}" style="display: none">
                                <input name="prodID" value="{{$item->PROD_ID}}" style="display: none">
                                {{--<button class="btn btn-inverse btn-lg" type="submit">Pay Paypal</button>--}}
                                <!-- PayPal Logo -->
                                    <table border="0" cellpadding="10" cellspacing="0" align="left">
                                        <tr>
                                            <td align="center"></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <a  href="javascript:;" onclick="document.getElementById('payment-form').submit();"  title="Pay using paypal"  >
                                                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/PP_AcceptanceMarkTray-NoDiscover_243x40.png" alt="Buy now with PayPal" />
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                <!-- PayPal Logo -->
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
            @endforeach

            <!-- BEGIN similar-product -->
            <h4 class="m-b-15 m-t-30">You Might Also Like</h4>
            <div class="row row-space-10">

            @foreach($randProd->take(6) as $item)
                <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="#" class="item-image">
                                <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                <div class="discount" >{{$discount=$item->PROD_DISCOUNT}}% OFF</div>
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="">{{$item->PROD_NAME}}<br />
                                        <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                    </a>
                                </h4>
                                <p class="item-desc" title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                <div class="item-price">
                                    @php
                                        $total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                        +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                        +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN';
                                        echo number_format(($discount)?$total-($total*($discount/100)):$total,2)
                                    @endphp
                                </div>
                                <div class="item-discount-price">{{($discount)?number_format($total,2):''}}</div>
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

@endsection

