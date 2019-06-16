    @extends('layouts.main')

    @section('title','Invoice')

@section('content')

<!-- begin breadcrumb -->
			<ol class="breadcrumb hidden-print pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Invoice</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header hidden-print">{{$invoice->INV_NO}} </h1>
			<!-- end page-header -->

			<!-- begin invoice -->
            <div class="invoice-company text-inverse f-w-600" style="padding: 10px;background: white;">
                                <span class="pull-right hidden-print">
                                <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
                                <a href="javascript:;" onclick="prints()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                                </span>
                Sympies (Affiliate Name)
            </div>
                <br>
			<div class="invoice">
                <!-- begin invoice-header -->
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->ORD_FROM_NAME }}</strong><br />
                            Email: {{$order->ORD_FROM_EMAIL}} <br />
                            Phone: {{$order->ORD_FROM_CONTACT}}<br />
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->ORD_TO_NAME }}</strong><br />
                            {{ $order->ORD_TO_ADDRESS }}<br />
                            Email: {{$order->ORD_TO_EMAIL}} <br />
                            Phone: {{$order->ORD_TO_CONTACT}}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Invoice / {{(new DateTime($invoice->created_at))->format('F') }} period</small>
                        <div class="date text-inverse m-t-5">{{(new DateTime($invoice->created_at))->format('F d, Y') }}</div>
                        <div class="invoice-detail">
                            {{$invoice->INV_NO}}<br />
                            {{$invoice->INV_DETAILS}}<br />
                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                	<!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Item DESCRIPTION</th>
                                    <th class="text-center" width="10%">Price</th>
                                    <th class="text-center" width="10%">Discount</th>
                                    <th class="text-center" width="10%">Quantity</th>
                                    <th class="text-right" width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order_items as $oi)

                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <center>
                                                        <a href="{{(!file_exists('uploads/'.$oi->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$oi->PROD_SKU.'.jpg')}}" data-lightbox="gallery-group-1">
                                                            <img style="width: 50%;height: 100%;" src="{{(!file_exists('uploads/'.$oi->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$oi->PROD_SKU.'.jpg')}}">
                                                        </a>
                                                    </center>
                                                    <br>
                                                </div>
                                                <div class="col-md-8">
                                                   <span class="text-inverse"> {{$oi->PROD_NAME}} </span><br />
                                                   <small>{{$oi->PROD_DESC}}</small>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE,2))}}</td>

                                        <td class="text-center">{{((!$oi->PROD_DISCOUNT)?'0':$oi->PROD_DISCOUNT).'%' }}</td>
                                        <td class="text-center">{{$oi->ORDI_QTY}}</td>
                                        <td class="text-right">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE *$oi->ORDI_QTY,2))}}</td>
                                    </tr>

                              @endforeach
                            </tbody>
                        </table>
                    </div>
                	<!-- end table-responsive -->
                	<!-- begin invoice-price -->
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>SUBTOTAL</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($payment->PAY_SUB_TOTAL,2))}}</span>
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <small>SALES TAX</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($payment->PAY_SALES_TAX,2))}}</span>
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <small>DELIVERY CHARGE</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($payment->PAY_DELIVERY_CHARGE,2)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL</small> <span class="f-w-600">{{Sympies::current_price(number_format($payment->PAY_AMOUNT_DUE,2)) }}</span>
                        </div>
                    </div>
                	<!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-note -->
                <div class="invoice-note">
                    * Make all cheques payable to [Your Company Name]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
                </div>
                <!-- end invoice-note -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> loyolapat.com</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> 09309758130</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> loyolapat04@gmail.com</span>
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
			<!-- end invoice -->
		</div>
		<!-- end #content -->

        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-theme-file="../assets/css/default/theme/default.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="../assets/css/default/theme/red.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="../assets/css/default/theme/blue.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="../assets/css/default/theme/purple.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="../assets/css/default/theme/orange.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="../assets/css/default/theme/black.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control form-control-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage">Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->

@endsection

@section('extrajs')

    <script>

        function prints(){
            $('body > :not(.invoice)').hide();
            $('.invoice').appendTo('body');
            window.print();
            location.reload();
        }



    </script>
@endsection
