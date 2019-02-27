@extends('layouts.main')

@section('title','Complete Orders')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage {{ucwords($status)}} Orders</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage {{ucwords($status)}} Orders <small>...</small></h1>
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
                    <h4 class="panel-title">Manage {{ucwords($status)}} Orders</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">...</div>
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
                            <th style="width: 10%">Code</th>
                            <th style="width: 20%">Sender Info</th>
                            <th style="width: 20%">Receiver Info</th>
                            <th style="width: 10%">Date Issued</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $item)
                            <tr>
                                <td>
                                    <center>
                                        <input type="checkbox" class="form-check-input" id="isChecked"  style="height: 20px;width: 20px;margin-top:20px;"/>
                                    </center>
                                </td>
                                <td><strong style="color:dimgray">{{$item->ORD_TRANS_CODE}}</strong>></td>
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
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if($item->ORD_DISPLAY_STATUS==1)
                                            <a id=deact  vals="{{$item->ORD_ID}}" class="btn btn-success" data-toggle="tooltip" title="Complete" href="javascript:;"><i class="fas fa-thumbs-up text-white"></i></a>
                                            <a id=deact  vals="{{$item->ORD_ID}}" class="btn btn-purple"  data-toggle="tooltip" title="View Invoice" href="javascript:;"><i class="fas fa-clipboard text-white"></i></a>
                                            <a id=deact  vals="{{$item->ORD_ID}}" class="btn btn-warning" data-toggle="tooltip" title="View Record" href="javascript:;"><i class="fas fa-align-justify text-white"></i></a>
                                            <a id=deact  vals="{{$item->ORD_ID}}" class="btn btn-primary" data-toggle="tooltip" title="Mark as Delivered" href="javascript:;"><i class="fas fa-truck text-white"></i></a>
                                            <a id=deact  vals="{{$item->ORD_ID}}" class="btn btn-danger" data-toggle="tooltip" title="Mark as Void" href="javascript:;"><i class="fa fa-ban text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->ORD_ID}}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 1%">
                                <input type="checkbox" class="form-check-input" style="height: 20px;width: 20px;margin-top:20px;" disabled />
                            </th>
                            <th>Code</th>
                            <th style="width: 20%">Sender Info</th>
                            <th style="width: 20%">Receiver Info</th>
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

@section('extrajs')

    <script>

        $('#data-table-buttons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[3, "desc" ]]
            ,'columnDefs':[
                { orderable: false, targets: [0,5] },
                // { visible: false, targets: [5,12,13] }
                ]
            ,dom: 'lBfrtip'
            ,   buttons: [
                { extend: 'copy', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },


            ],
        });


        $('input[id=checkAll]').on('click',function(){
            if($('input[id=checkAll]').prop('checked'))
                $('input[id=isChecked]').prop('checked',true);
            else
                $('input[id=isChecked]').prop('checked',false);
        });




    </script>
@endsection
