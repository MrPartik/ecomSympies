@extends('layouts.main')

@section('title','Complete Orders')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Orders</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Orders <small>...</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-2 -->

        <!-- end col-2 -->
        <!-- begin col-10 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        {{--<a href="{{action('manageTax@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>--}}
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Orders</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">
                    <a id=shippedSome  vals="0" class="btn btn-primary" data-toggle="tooltip" title="Mark as Delivered" href="javascript:;">(<span id="countChecked">0</span>) <i class="fas fa-truck text-white"></i> Deliver Order</a>
                    <a id=voidSome  vals="0" class="btn btn-danger" data-toggle="tooltip" title="Mark as Void" href="javascript:;">(<span id="countChecked">0</span>) <i class="fa fa-ban text-white"></i> Void Order</a>

                </div>
                <!-- begin alert -->

                @if(session('success') || session('error') )
                    <div class="alert alert-{{(session('success')?'success':'danger')}} fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{(session('success'))?session('success'):session('error')}}
                </div>
                @endif
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                <input type="checkbox" class="form-check-input" id="checkAll"  style="height: 20px;width: 20px;margin-top:20px;"/>
                            </th>
                            <th style="width: 20%">Order Information</th>
                            <th style="width: 15%">Sender Info</th>
                            <th style="width: 20%">Receiver Info</th>
                            <th style="width: 5%">Status</th>
                            <th style="width: 10%">Date Issued</th>
                            <th style="width: 20%">Action</th>
                        </thead>
                        <tbody>
                        @foreach($order as $item)

                            <tr>
                                <td>
                                    <center>
                                        <input vals="{{$item->ORD_ID}}" type="checkbox" class="form-check-input" id="isChecked"  style="height: 20px;width: 20px;margin-top:20px;"/>
                                    </center>
                                </td>
                                <td>
                                    <strong>Transaction Code: </strong>{{$item->ORD_TRANS_CODE}}<br>
                                    @foreach($order_item->where('ORD_ID',$item->ORD_ID) as $ord_item)
                                        Product Name: {{$ord_item->rProductInfo->PROD_NAME}}<br>
                                        Qty: {{$ord_item->ORDI_QTY}}<br>
                                        Total Price: {{Sympies::current_price(number_format($ord_item->ORDI_SOLD_PRICE,2))}}
                                    @endforeach
                                </td>
                                <td>
                                    <strong>{{ $item->ORD_FROM_NAME}}</strong><br>
                                    <small>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Contact No: {{$item->ORD_FROM_CONTACT}}
                                        </span><br>

                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Email: <a target="_blank" href="mailto:{{ $item->ORD_FROM_EMAIL}}">{{ $item->ORD_FROM_EMAIL}}</a>
                                        </span>
                                    </small>
                                </td>
                                <td>

                                    <strong>{{ $item->ORD_TO_NAME}}</strong><br>

                                    <small>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Shipping Address: {{ $item->ORD_TO_ADDRESS}}
                                        </span> <br>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Contact No: {{$item->ORD_TO_CONTACT}}
                                        </span> <br>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Email: <a target="_blank" href="mailto:{{$item->ORD_TO_EMAIL}}">{{$item->ORD_TO_EMAIL}}</a>
                                        </span>
                                    </small><br>
                                </td>
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

                                <td style="background: {{$color}}">{{$status}}</td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                            <a id=shipped  vals="{{$item->ORD_ID}}" class="btn btn-primary" data-toggle="tooltip" title="Mark as Delivered" href="javascript:;"><i class="fas fa-truck text-white"></i></a>
                                            <a id=invoice  vals="{{$item->ORD_ID}}" class="btn btn-purple"  data-toggle="tooltip" title="View Invoice" href="javascript:;"><i class="fas fa-clipboard text-white"></i></a>
                                            <a id=record  vals="{{$item->ORD_ID}}" class="btn btn-warning" data-toggle="tooltip" title="View Record" href="javascript:;"><i class="fas fa-align-justify text-white"></i></a>
                                        <a id=void  vals="{{$item->ORD_ID}}" class="btn btn-danger" data-toggle="tooltip" title="Mark as Void" href="javascript:;"><i class="fa fa-ban text-white"></i></a>
                                        <a id=refund  vals="{{$item->ORD_ID}}" class="btn btn-danger" data-toggle="tooltip" title="Mark as Refund" href="javascript:;"><i class="fa fa-exchange-alt text-white"></i></a>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 1%">
                                <input type="checkbox" class="form-check-input" style="height: 20px;width: 20px;margin-top:20px;" disabled />
                            </th>
                            <th>Order Information</th>
                            <th >Sender Info</th>
                            <th >Receiver Info</th>
                            <th >Status</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->



@endsection

@section('extrajs$('#data-table-buttons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[3, "desc" ]]
            ,'columnDefs':[
                { orderable: false, targets: [0,6] },
                // { visible: false, targets: [5,12,13] }
                ]
            ,dom: 'lBfrtip'
            ,   buttons: [
                { extend: 'copy', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
            ],
        });




        $('input[id=checkAll]').on('change',function(){
            if($('input[id=checkAll]').prop('checked'))
                $('input[id=isChecked]').prop('checked',true);
            else
                $('input[id=isChecked]').prop('checked',false);

            countChecked();
        });

        $('input[id=isChecked]').on('change',function(){

            if($('input[id=isChecked]:checked').length == $('input[id=isChecked]').length)
                $('input[id=checkAll]').prop('checked',true);
            else
                $('input[id=checkAll]').prop('checked',false);

            countChecked();

        });

        function countChecked(){
            $('span[id=countChecked]').text($('input[id=isChecked]:checked').length);
            if($('input[id=isChecked]:checked').length==0){
                $('a[id=shippedSome]').prop('disabled',true);
                $('a[id=voidSome]').prop('disabled',true);
            }else{
                $('a[id=shippedSome]').prop('disabled',false);
                $('a[id=voidSome]').prop('disabled',false);
            }

            orderIDs = [];
            $.each($('input[id=isChecked]:checked'),function(){
                orderIDs.push($(this).attr('vals'));

            })
            console.log(orderIDs);

        }



    </script>
@endsection
