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
        <h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">

        </div>
        <!-- end row -->

@endsection

@push('scripts')
    <script src="/assets/plugins/flot/dom-tools.js"></script>
    <script src="/assets/plugins/flot/EventEmitter.js"></script>
    <script src="/assets/plugins/flot/flot.js"></script>
    <script src="/assets/plugins/flot/flot.time.js"></script>
    <script src="/assets/plugins/flot/flot.pie.js"></script>
    <script src="/assets/plugins/gritter/js/jquery.gritter.min.js"></script>
    <script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/assets/js/demo/dashboard-v1.js"></script>
    <script>
        $(document).ready(function() {
            Dashboard.init();
        });
    </script>
@endpush
