<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{Auth::user()->name}}
                        <small>Affiliates Profile</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                </ul>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>

            <li class="{{Request::is('dashboard')?'active':''}}">
                <a href="{{url('dashboard')}}">
                    <i class="fa fa-th-large"></i>
                    <span>Dashboard </span>
                </a>
            </li>
            <li class="has-sub {{(Route::is('prodList')||Route::is('prodCat'))?'active':''}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-gem"></i>
                    <span>Manage Products</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Route::is('prodList')?'active':''}}"><a href="{{url('product/list')}}">Product List</a></li>
                    <li class="{{Route::is('prodCat')?'active':''}}"><a href="{{url('product/category')}}">Product Category</a></li>

                </ul>
            </li>
            <li class="{{Route::is('tax')?'active':''}}">
                <a href="{{url('tax')}}">
                    <i class="fa fa-gem"></i>
                    <span>Manage Tax </span>
                </a>
            </li>

            <li class="has-sub {{(Request::is('sales-markup')||Request::is('sales-vat')||Request::is('sales'))?'active':'' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-users"></i>
                    <span>Sales</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Request::is('sales')?'active':''}}"><a href="{{url('sales')}}">Sales</a></li>
                    <li class="{{Request::is('sales-markup')?'active':''}}"><a href="{{url('sales-markup')}}">Markup Sales</a></li>
                    <li class="{{Request::is('sales-vat')?'active':''}}"><a href="{{url('sales-vat')}}">VAT Sales</a></li>
                </ul>
            </li>

            <li class="has-sub {{(Route::is('users')||Route::is('affiliates'))?'active':''}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Route::is('affiliates')?'active':''}}"><a href="{{url('affiliates')}}">Affiliate's List</a></li>
                    <li class="{{Route::is('users')?'active':''}}"><a href="{{url('users')}}">User's List</a></li>

                </ul>
            </li>


            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>




