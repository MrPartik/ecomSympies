@extends('layouts.main')

@section('title','Currencies')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Currencies</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Currencies <small>...</small></h1>
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

                        <a href="{{action('manageCurrency@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Currencies</h4>
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
                            <th style="width: 30%">Info</th>
                            <th>Rate</th>
                            <th>Tax</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($curr as $item)
                            <tr>
                                <td><strong>{{ $item->CURR_COUNTRY }}</strong><label>({{$item->CURR_ACC}})</label>
                                    <br><small>{{ $item->CURR_SYMBOL }}</small></td>
                                <td>{{$item->CURR_RATE}}</td>
                                <td>{{ $item->rTaxTableProfile->TAXP_RATE  }}</td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>

                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 30%">Info</th>
                            <th>Rate</th>
                            <th>Tax</th>
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
    <div class="modal modal-message fade" id="taxreferencesetup" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Tax</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post" id="taxModal" action="{{url('tax')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="POST" />
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" name=taxname placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rate</label>
                                        <input class="form-control" name=taxrate type="number" placeholder="Rate" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control " name="taxtype" style="width: 100%;" required>
                                            <option selected="selected"  disabled>Please Select Type</option>
                                            <option value=0 >Percentage</option>
                                            <option value=1 >Fixed</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name=taxdesc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="margin-right: 10px;">
                                    <button class="btn btn-success" type="submit" >Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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



        $("a[id='deact']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='deactSave']").on('click',function () {
            swal({
                title: "This record will be deactivated?"
                , text: "After this action, this record is not available, unless it is activated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: '/tax/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:0  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });

                }
            });
            // });
        });

        $("a[id='act']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='actSave']").on('click',function () {

            swal({
                title: "This record will be activated?"
                , text: "After this action, this record is now available, unless it is deactivated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/tax/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:1  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });
                }
            });

            // });
        });


    </script>
@endsection
