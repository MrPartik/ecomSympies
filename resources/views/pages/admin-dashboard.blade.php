@extends('layouts.main')

@section('title', 'Dashboard')

@push('css')
    <link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('content')
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Dashboard <small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div id="stockGraph" style="width: 100%"></div>
        </div>
        <!-- end row -->

@endsection

@section('extrajs')

    <script>
        $(document).ready(function() {
            Dashboard.init();
        });



        $.getJSON('{{url('/salesJSON')}}', function (data) {

            Highcharts.stockChart('stockGraph', {
                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'Gross Sales'
                },

                series: [{
                    name: 'Gross Sale Price',
                    data: data, 
                    type:'area',
                    tooltip: {
                        valueDecimals: 2
                    },
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    threshold: null
                }]
            });
        });


    </script>
@endsection
