@php
    $account = Session::get('sympiesAccount');
@endphp
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Sympies | @yield('title')</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{asset('assets/plugins/bootstrap3/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/style.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/theme/default.css')}}" id="theme" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
</head>

<body>
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade">
        <!-- BEGIN #top-nav -->
        <div id="top-nav" class="top-nav">
            <!-- BEGIN container -->
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown dropdown-hover">
                            <a href="#" data-toggle="dropdown"><img src="{{asset('assets/img/flag/flag-english.png')}}" class="flag-img" alt="" /> English <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="{{asset('assets/img/flag/flag-english.png')}}" class="flag-img" alt="" /> English</a></li>
                                <li><a href="#"><img src="{{asset('assets/img/flag/flag-german.png')}}" class="flag-img" alt="" /> German</a></li>
                                <li><a href="#"><img src="{{asset('assets/img/flag/flag-spanish.png')}}" class="flag-img" alt="" /> Spanish</a></li>
                                <li><a href="#"><img src="{{asset('assets/img/flag/flag-french.png')}}" class="flag-img" alt="" /> French</a></li>
                                <li><a href="#"><img src="{{asset('assets/img/flag/flag-chinese.png')}}" class="flag-img" alt="" /> Chinese</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Customer Care</a></li>
                        <li><a href="#">Order Tracker</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li><a href="#">Career</a></li>
                        <li><a href="#">Our Forum</a></li> -->
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#"><i class="fa fa-facebook f-s-14"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter f-s-14"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram f-s-14"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble f-s-14"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus f-s-14"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #top-nav -->

        <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN header-container -->
                <div class="header-container">
                    <!-- BEGIN navbar-header -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-logo">
                            <a href="{{url('/')}}">
                                <span>Symp</span>ies
                                <small>e-commerce, 360° of Kindness</small>
                            </a>
                        </div>
                    </div>
                    <!-- END navbar-header -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">
                                <li class="active"><a href="{{url('/')}}">Home</a></li>
                                {{--<li class="dropdown dropdown-full-width dropdown-hover">--}}
                                    {{--<a href="#" data-toggle="dropdown">--}}
                                        {{--Our Store --}}
                                        {{--<i class="fa fa-angle-down"></i>--}}
                                        {{--<span class="arrow top"></span>--}}
                                    {{--</a>--}}
                                    {{--<!-- BEGIN dropdown-menu -->--}}
                                    {{--<div class="dropdown-menu p-0">--}}
                                        {{--<!-- BEGIN dropdown-menu-container -->--}}
                                        {{--<div class="dropdown-menu-container">--}}
                                            {{--<!-- BEGIN dropdown-menu-sidebar -->--}}
                                            {{--<div class="dropdown-menu-sidebar">--}}
                                                {{--<h4 class="title">Shop By Categories</h4>--}}
                                                {{--<ul class="dropdown-menu-list">--}}
                                                    {{--<li><a href="product.html">Mobile Phone <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">Tablet <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">Laptop <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">Desktop <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">TV <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">Speaker <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                    {{--<li><a href="product.html">Gadget <i class="fa fa-angle-right pull-right"></i></a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<!-- END dropdown-menu-sidebar -->--}}
                                            {{--<!-- BEGIN dropdown-menu-content -->--}}
                                            {{--<div class="dropdown-menu-content">--}}
                                                {{--<h4 class="title">Shop By Popular Phone</h4>--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-md-3">--}}
                                                        {{--<ul class="dropdown-menu-list">--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> iPhone 7</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> iPhone 6s</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> iPhone 6</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> iPhone 5s</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> iPhone 5</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-md-3">--}}
                                                        {{--<ul class="dropdown-menu-list">--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Galaxy S7</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Galaxy A9</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Galaxy J3</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Galaxy Note 5</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Galaxy S7</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-md-3">--}}
                                                        {{--<ul class="dropdown-menu-list">--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Lumia 730</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Lumia 735</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Lumia 830</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Lumia 820</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Lumia Icon</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-md-3">--}}
                                                        {{--<ul class="dropdown-menu-list">--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Xperia X</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Xperia Z5</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Xperia M5</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Xperia C5</a></li>--}}
                                                            {{--<li><a href="product_detail.html"><i class="fa fa-fw fa-angle-right text-muted"></i> Xperia C4</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<h4 class="title">Shop By Brand</h4>--}}
                                                {{--<ul class="dropdown-brand-list m-b-0">--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-apple.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-samsung.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-htc.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-microsoft.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-nokia.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-blackberry.png" alt="" /></a></li>--}}
                                                    {{--<li><a href="product.html"><img src="../assets/img/brand/brand-sony.png" alt="" /></a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<!-- END dropdown-menu-content -->--}}
                                        {{--</div>--}}
                                        {{--<!-- END dropdown-menu-container -->--}}
                                    {{--</div>--}}
                                    {{--<!-- END dropdown-menu -->--}}
                                {{--</li>--}}
                                <!-- <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        Accessories
                                        <i class="fa fa-angle-down"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="product.html">Mobile Phone</a></li>
                                        <li><a href="product.html">Tablet</a></li>
                                        <li><a href="product.html">TV</a></li>
                                        <li><a href="product.html">Desktop</a></li>
                                        <li><a href="product.html">Laptop</a></li>
                                        <li><a href="product.html">Speaker</a></li>
                                        <li><a href="product.html">Gadget</a></li>
                                    </ul>
                                </li> -->
                                <!-- <li><a href="product.html">New Arrival</a></li>  -->
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fa fa-search search-btn"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu p-15">
                                        <form action="search_results.html" method="POST" name="search_form">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search" class="form-control bg-silver-lighter" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END header-nav -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav pull-right">
                            <!-- <li class="dropdown dropdown-hover">
                                <a href="#" class="header-cart" data-toggle="dropdown">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="total">2</span>
                                    <span class="arrow top"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-cart p-0">
                                    <div class="cart-header">
                                        <h4 class="cart-title">Shopping Bag (1) </h4>
                                    </div>
                                    <div class="cart-body">
                                        <ul class="cart-item">
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-ipad.jpg" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>iPad Pro Wi-Fi 128GB - Silver</h4>
                                                    <p class="price">$699.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-imac.jpg" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>21.5-inch iMac</h4>
                                                    <p class="price">$1299.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-iphone.png" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>iPhone 6s 16GB - Silver</h4>
                                                    <p class="price">$649.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-footer">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <a href="checkout_cart.html" class="btn btn-default btn-block">View Cart</a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="checkout_cart.html" class="btn btn-inverse btn-block">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li> -->
                            <li>
                                <a href="javascript:;">
                                    <img src="{{asset('assets/img/user/user-1.jpg')}}" class="user-img" alt="" />
                                    <span class="hidden-md hidden-sm hidden-xs">
                                      {{(!is_null($account))?$account['NAME']:'Not Logged In'}}

                                    </span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a target = "_blank" href="{{url('login')}}">Affiliate</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->

        @yield('content')

        <!-- BEGIN #footer -->
        <div id="footer" class="footer">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">ABOUT US</h4>
                        <p>  </p>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">RELATED LINKS</h4>
                        <ul class="fa-ul">
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Shopping Help</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Terms of Use</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Contact Us</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Careers</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Payment Method</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Sales & Refund</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Sitemap</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Privacy & Policy</a></li>
                        </ul>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">LATEST PRODUCT</h4>
                        <ul class="list-unstyled list-product">
                            @foreach($Allprod->sortby('created_at')->take(3) as $item)
                            <li>
                                <div class="image" style="overflow:hidden">
                                    <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                </div>
                                <div class="info">
                                    <h4 class="info-title">{{$item->PROD_NAME}}</h4>
                                    <div class="price">
                                        @php
                                            $total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                            +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                            +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN';
                                            echo number_format($total,2)
                                        @endphp
                                        </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">OUR CONTACT</h4>
                        <address>
                            <strong>Sympies, Inc.</strong><br />
                            Address<br /><br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Fax">Fax:</abbr> (123) 456-7891<br />
                            <abbr title="Email">Email:</abbr> <a href="mailto:sales@myshop.com">sales@myshop.com</a><br />
                            <abbr title="Skype">Skype:</abbr> <a href="skype:myshop">myshop</a>
                        </address>
                    </div>
                    <!-- END col-3 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer -->

        <!-- BEGIN #footer-copyright -->
        <div id="footer-copyright" class="footer-copyright">
            <!-- BEGIN container -->
            <div class="container">
                <div class="payment-method">
                    <img src="{{asset('assets/img/payment/payment-method.png')}}" alt="" />
                </div>
                <div class="copyright">
                    Copyright &copy; {{date('Y')}} Sympies . All rights reserved.
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer-copyright -->
    </div>
    <!-- END #page-container -->

    <!-- begin theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
        <div class="theme-panel-content">
            <ul class="theme-list clearfix">
                <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="{{asset('assets/css/e-commerce/theme/purple.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="{{asset('assets/css/e-commerce/theme/blue.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                <li class="active"><a href="javascript:;" class="bg-green" data-theme-file="{{asset('assets/css/e-commerce/theme/default.css')}}" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="{{asset('assets/css/e-commerce/theme/orange.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="{{asset('assets/css/e-commerce/theme/red.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
            </ul>
        </div>
    </div>
    <!-- end theme-panel -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap3/js/bootstrap.min.js')}}"></script>
	<!--[if lt IE 9]>
		<script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>
		<script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>
		<script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>
	<![endif]-->
	<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('assets/js/e-commerce/apps.min.js')}}"></script>
    <script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
    <script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
	    $(document).ready(function() {
	        App.init();
            FormWizardValidation.init();
	    });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const moneyFormat = num => {
            const n = String(num),
                p = n.indexOf('.')
            return n.replace(
                /\d(?=(?:\d{3})+(?:\.|$))/g,
                (m, i) => p < 0 || i < p ? `${m},` : m
            )
        }
	</script>

    @yield('extrajs')
</body>
</html>
