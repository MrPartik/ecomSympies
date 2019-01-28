
@extends('layouts.frontend-main')

@section('title','Products')

@section('content')
      <!-- BEGIN #slider -->
      <div id="slider" class="section-container p-0 bg-black-darker">
            <!-- BEGIN carousel -->
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <!-- BEGIN carousel-inner -->
                <div class="carousel-inner"> 
                    <!-- BEGIN item -->
                    <div class="item active">
                        <img src="../assets/img/slider/slider-1-cover.jpg" class="bg-cover-img" alt="" />
                        <div class="container">
                            <img src="../assets/img/slider/slider-1-product.png" class="product-img right bottom fadeInRight animated" alt="" />
                        </div>
                        <div class="carousel-caption carousel-caption-left">
                            <div class="container">
                                <h3 class="title m-b-5 fadeInLeftBig animated">iMac</h3> 
                                <p class="m-b-15 fadeInLeftBig animated">The vision is brighter than ever.</p>
                                <div class="price m-b-30 fadeInLeftBig animated"><small>from</small> <span>$2299.00</span></div>
                                <a href="product_detail.html" class="btn btn-outline btn-lg fadeInLeftBig animated">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- END item -->
                    <!-- BEGIN item -->
                    <div class="item">
                        <img src="../assets/img/slider/slider-2-cover.jpg" class="bg-cover-img" alt="" />
                        <div class="container">
                            <img src="../assets/img/slider/slider-2-product.png" class="product-img left bottom fadeInLeft animated" alt="" />
                        </div>
                        <div class="carousel-caption carousel-caption-right">
                            <div class="container">
                                <h3 class="title m-b-5 fadeInRightBig animated">iPhone X</h3> 
                                <p class="m-b-15 fadeInRightBig animated">Say hello to the future.</p>
                                <div class="price m-b-30 fadeInRightBig animated"><small>from</small> <span>$1,149.00</span></div>
                                <a href="product_detail.html" class="btn btn-outline btn-lg fadeInRightBig animated">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- END item -->
                    <!-- BEGIN item -->
                    <div class="item">
                        <img src="../assets/img/slider/slider-3-cover.jpg" class="bg-cover-img" alt="" />
                        <div class="carousel-caption">
                            <div class="container">
                                <h3 class="title m-b-5 fadeInDownBig animated">Macbook Air</h3> 
                                <p class="m-b-15 fadeInDownBig animated">Thin.Light.Powerful.<br />And ready for anything</p>
                                <div class="price fadeInDownBig animated"><small>from</small> <span>$999.00</span></div>
                                <a href="product_detail.html" class="btn btn-outline btn-lg fadeInUpBig animated">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- END item -->
                </div>
                <!-- END carousel-inner -->
                <a class="left carousel-control" href="#main-carousel" data-slide="prev"> 
                    <i class="fa fa-angle-left"></i> 
                </a>
                <a class="right carousel-control" href="#main-carousel" data-slide="next"> 
                    <i class="fa fa-angle-right"></i> 
                </a>
            </div>
            <!-- END carousel -->
        </div>
        <!-- END #slider -->
     
    
        <!-- BEGIN #trending-items -->
        <div id="trending-items" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    <!-- <a href="#" class="pull-right m-l-5"><i class="fa fa-angle-right f-s-18"></i></a>
                    <a href="#" class="pull-right"><i class="fa fa-angle-left f-s-18"></i></a> -->
                    
                    <a href="#" class="pull-right">SHOW ALL</a> 
                    Trending Products
                    <small>Shop and get gifts for your friends and your family!</small>
                </h4>
                <!-- END section-title -->
            
                <!-- BEGIN row -->
                <div class="row row-space-10">
                
                    @foreach($Allprod as $item)
                    <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="#" class="item-image">
                                <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                    <div class="discount" >0% OFF</div>
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                <a href="">{{$item->PROD_NAME}}<br />
                                    <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                </a>
                                </h4>
                                <p class="item-desc" title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                <div class="item-price">{{$total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                            +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                            +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN'}}</div>
                                <!-- <div class="item-discount-price"></div> -->
                            </div>
                        </div>
                        <!-- END item -->
                    </div>
                    <!-- END col-2 -->
                    @endforeach
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #trending-items -->
    
        <!-- BEGIN #mobile-list -->
        <div id="mobile-list" class="section-container bg-silver p-t-0">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    <a href="#" class="pull-right">SHOW ALL</a>
                    Affiliates
                    <small>Shop and get gifts for your friends and your family!</small>
                </h4>
                <!-- END section-title -->
                <!-- BEGIN category-container -->
                <div class="category-container">
                    <!-- BEGIN category-sidebar -->
                    <div class="category-sidebar">
                        <ul class="category-list">
                            <li class="list-header">All Affiliates</li>
                            @foreach($aff as $item)
                                <li><a href="#">{{$item->AFF_NAME}}</a></li> 
                            @endforeach
                        </ul>
                    </div>
                    <!-- END category-sidebar -->
                    <!-- BEGIN category-detail -->
                    <div class="category-detail">
                        <!-- BEGIN category-item -->
                        <!-- <a href="#" class="category-item full">
                            <div class="item">
                                <div class="item-cover">
                                    <img src="../assets/img/product/product-samsung-s7-edge.jpg" alt="" />
                                </div>
                                <div class="item-info bottom">
                                    <h4 class="item-title">Samsung Galaxy s7 Edge + Geat 360 + Gear VR</h4>
                                    <p class="item-desc">Redefine what a phone can do</p>
                                    <div class="item-price">$799.00</div>
                                </div>
                            </div>
                        </a> -->
                        <!-- END category-item -->
                        <!-- BEGIN category-item -->
                        <div class="category-item list">
                            
                            @php $i=1 @endphp
                            @foreach($Allprod as $item)
                            <!-- BEGIN item-row -->
                            @if($i==1 || $i==4 || $i==7 )
                            <div class="item-row">
                            @endif 
                               <!-- BEGIN item -->
                            <div class="item item-thumbnail">
                                <a href="#" class="item-image">
                                    <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                    <div class="discount" >0% OFF</div>
                                </a>
                                <div class="item-info">
                                    <h4 class="item-title">
                                        <a href="">{{$item->PROD_NAME}}<br />
                                            <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                        </a>
                                    </h4>
                                    <p class="item-desc"  title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                    <div class="item-price">{{$total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                                +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                                +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN'}}</div>
                                    <!-- <div class="item-discount-price"></div> -->
                                </div>
                            </div>
                                <!-- END item --> 
                                
                            @if($i==3 || $i==6 || $i==9 || count($Allprod)==$i )
                            </div>
                            <!-- END item-row -->
                             @endif
                             
                             @php $i++ @endphp
                             @endforeach
                        </div>
                        <!-- END category-item -->
                    </div>
                    <!-- END category-detail -->
                </div>
                <!-- END category-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #mobile-list -->
    
        <!-- BEGIN #tablet-list -->
        <div id="tablet-list" class="section-container bg-silver p-t-0">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    <a href="#" class="pull-right">SHOW ALL</a>
                    Categories
                    <small>Shop and get gifts for your friends and your family!</small>
                </h4>
                <!-- END section-title -->
                <!-- BEGIN category-container -->
                <div class="category-container">
                    <!-- BEGIN category-sidebar -->
                    <div class="category-sidebar">
                        <ul class="category-list">
                            <li class="list-header">All Categories</li>
                            
                        @foreach($cat->where('PRODT_PARENT','<>',null) as $item)
                            <li title="{{$item->rProductType->PRODT_TITLE}}"><a href="#">{{$item->PRODT_TITLE}}</a></li>  
                        @endforeach
                        </ul>
                    </div>
                    <!-- END category-sidebar -->
                    <!-- BEGIN category-detail -->
                    <div class="category-detail">
                        <!-- BEGIN category-item -->
                        <!-- <a href="#" class="category-item full">
                            <div class="item">
                                <div class="item-cover">
                                    <img src="{{asset('uPackage.png')}}" alt="" />
                                </div>
                                <div class="item-info bottom">
                                    <h4 class="item-title">Huawei MediaPad T1 7.0</h4>
                                    <p class="item-desc">Vibrant colors. Beautifully displayed</p>
                                    <div class="item-price">$299.00</div>
                                </div>
                            </div>
                        </a> -->
                        <!-- END category-item -->
                        
                        
                        <!-- BEGIN category-item -->
                        <div class="category-item list">
                            
                            @php $i=1 @endphp
                            @foreach($Allprod as $item)
                            <!-- BEGIN item-row -->
                            @if($i==1 || $i==4 || $i==7 )
                            <div class="item-row">
                            @endif 
                               <!-- BEGIN item -->
                            <div class="item item-thumbnail">
                                <a href="#" class="item-image">
                                    <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                    <div class="discount" >0% OFF</div>
                                </a>
                                <div class="item-info">
                                    <h4 class="item-title">
                                        <a href="">{{$item->PROD_NAME}}<br />
                                        <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span></a>
                                    </h4>
                                    <p class="item-desc"  title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                    <div class="item-price">{{$total=($item->PROD_IS_APPROVED==1)?(($item->PROD_REBATE/100)* $item->PROD_BASE_PRICE)
                                                +(($item->rTaxTableProfile->TAXP_TYPE==0)?($item->rTaxTableProfile->TAXP_RATE/100)* $item->PROD_BASE_PRICE:($item->rTaxTableProfile->TAXP_RATE)+ $item->PROD_BASE_PRICE)
                                                +(($item->PROD_MARKUP/100)* $item->PROD_BASE_PRICE)+$item->PROD_BASE_PRICE:'NAN'}}</div>
                                    <!-- <div class="item-discount-price"></div> --> 
                                </div>
                            </div>
                                <!-- END item --> 
                                
                            @if($i==3 || $i==6 || $i==9 || count($Allprod)==$i )
                            </div>
                            <!-- END item-row -->
                             @endif
                             
                             @php $i++ @endphp
                             @endforeach
                        </div>
                        <!-- END category-item -->
                    </div>
                    <!-- END category-detail -->
                </div>
                <!-- END category-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #tablet-list -->
    
        <!-- BEGIN #policy -->
        <div id="policy" class="section-container p-t-30 p-b-30">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- BEGIN policy -->
                        <div class="policy">
                            <div class="policy-icon"><i class="fa fa-truck"></i></div>
                            <div class="policy-info">
                                <h4>Free Delivery Over $100</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <!-- END policy -->
                    </div>
                    <!-- END col-4 -->
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- BEGIN policy -->
                        <div class="policy">
                            <div class="policy-icon"><i class="fa fa-shield"></i></div>
                            <div class="policy-info">
                                <h4>1 Year Warranty For Phones</h4>
                                <p>Cras laoreet urna id dui malesuada gravida. <br />Duis a lobortis dui.</p>
                            </div>
                        </div>
                        <!-- END policy -->
                    </div>
                    <!-- END col-4 -->
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- BEGIN policy -->
                        <div class="policy">
                            <div class="policy-icon"><i class="fa fa-user-md"></i></div>
                            <div class="policy-info">
                                <h4>6 Month Warranty For Accessories</h4>
                                <p>Fusce ut euismod orci. Morbi auctor, sapien non eleifend iaculis.</p>
                            </div>
                        </div>
                        <!-- END policy -->
                    </div>
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #policy -->
    
        <!-- BEGIN #subscribe -->
        <div id="subscribe" class="section-container bg-silver p-t-30 p-b-30">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN subscription -->
                        <div class="subscription">
                            <div class="subscription-intro">
                                <h4> LET'S STAY IN TOUCH</h4>
                                <p>Get updates on sales specials and more</p>
                            </div>
                            <div class="subscription-form">
                                <form name="subscription_form" action="index.html" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email Address" />
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-inverse"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END subscription -->
                    </div>
                    <!-- END col-6 -->
                    <!-- BEGIN col-6 -->
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN social -->
                        <div class="social">
                            <div class="social-intro">
                                <h4>FOLLOW US</h4>
                                <p>We want to hear from you!</p>
                            </div>
                            <div class="social-list">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                        <!-- END social -->
                    </div>
                    <!-- END col-6 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #subscribe -->
    

@endsection
