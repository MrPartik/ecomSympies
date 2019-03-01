@extends('layouts.main')

@section('title','Sales')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Sales</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Sales <small>...</small></h1>
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

                         <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Sales</h4>
                </div>
                <!-- end panel-heading -->

                {{--<div class="panel-body bg-black text-white">...</div>--}}
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
                <!-- begin nav-tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-items">
                        <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                            <span class="d-sm-none">Tab 1</span>
                            <span class="d-sm-block d-none">Default Tab 1</span>
                        </a>
                    </li>
                    <li class="nav-items">
                        <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Tab 2</span>
                            <span class="d-sm-block d-none">Default Tab 2</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Tab 3</span>
                            <span class="d-sm-block d-none">Default Tab 3</span>
                        </a>
                    </li>
                </ul>
                <!-- end nav-tabs -->
                <!-- begin tab-content -->
                <div class="tab-content">
                    <!-- begin tab-pane -->
                    <div class="tab-pane fade active show" id="default-tab-1">
                        <h3 class="m-t-10"><i class="fa fa-cog"></i> Lorem ipsum dolor sit amet</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor,
                            est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis
                            dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus.
                            Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
                        </p>
                        <p class="text-right m-b-0">
                            <a href="javascript:;" class="btn btn-white m-r-5">Default</a>
                            <a href="javascript:;" class="btn btn-primary">Primary</a>
                        </p>
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane fade" id="default-tab-2">
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <p>
                            Nullam ac sapien justo. Nam augue mauris, malesuada non magna sed, feugiat blandit ligula.
                            In tristique tincidunt purus id iaculis. Pellentesque volutpat tortor a mauris convallis,
                            sit amet scelerisque lectus adipiscing.
                        </p>
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane fade" id="default-tab-3">
                        <p>
								<span class="fa-stack fa-4x pull-left m-r-10">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fab fa-twitter fa-stack-1x"></i>
								</span>
                            Praesent tincidunt nulla ut elit vestibulum viverra. Sed placerat magna eget eros accumsan elementum.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis lobortis neque.
                            Maecenas justo odio, bibendum fringilla quam nec, commodo rutrum quam.
                            Donec cursus erat in lacus congue sodales. Nunc bibendum id augue sit amet placerat.
                            Quisque et quam id felis tempus volutpat at at diam. Vivamus ac diam turpis.Sed at lacinia augue.
                            Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla.
                            Quisque adipiscing dui nec orci fermentum blandit.
                            Sed at lacinia augue. Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla.
                            Quisque adipiscing dui nec orci fermentum blandit.
                        </p>
                    </div>
                    <!-- end tab-pane -->
                </div>
                <!-- end tab-content -->

                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Type</th>
                            <th>Rate</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <th style="width: 30%">Info</th>
                        <th>Type</th>
                        <th>Rate</th>
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



    </script>
@endsection
