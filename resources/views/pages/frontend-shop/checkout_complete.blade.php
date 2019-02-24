
@extends('layouts.frontend-main')

@section('title','Checkout Complete')

@section('content')

    {{$info}}
    <div class="section-container" id="checkout-cart">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN checkout -->
            <div class="checkout">
                <form action="checkout_info.html" method="POST" name="form_checkout">
                    <!-- BEGIN checkout-header -->
                    <div class="checkout-header">
                        <!-- BEGIN row -->
                        <div class="row">
                            <div class="col-md-12 text-white" style="padding-bottom: 20px;">
                                <strong>Thank you! </strong>
                                <p>Your Payment has been successfully processed with the following details.</p>
                            </div>
                        </div>
                        <!-- END row -->
                    </div>
                    <!-- END checkout-header -->
                    <!-- BEGIN checkout-body -->
                    <div class="checkout-body">
                        <!-- BEGIN checkout-message -->
                        <div class="checkout-message">

                            <div class="table-responsive2">
                                <table class="table table-payment-summary">
                                    <tbody>
                                    <tr>
                                        <td class="field">Transaction Status</td>
                                        <td class="value">Success</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Transaction Reference No.</td>
                                        <td class="value">REF000001</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Bank Authorised Code</td>
                                        <td class="value">AUTH000001</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Transaction Date and Time</td>
                                        <td class="value">05 APR 2016 07:30PM</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Orders</td>
                                        <td class="value product-summary">
                                            <div class="product-summary-img">
                                                <img src="../assets/img/product/product-iphone-6s-plus.png" alt="" />
                                            </div>
                                            <div class="product-summary-info">
                                                <div class="title">iPhone 6s Plus 16GB (Silver)</div>
                                                <div class="desc">Delivers Tue 26/04/2016 - Free</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Payment Amount (RM)</td>
                                        <td class="value">$999.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-muted text-center m-b-0">Should you require any assistance, you can get in touch with Support Team at (123) 456-7890</p>
                        </div>
                        <!-- END checkout-message -->
                    </div>
                    <!-- END checkout-body -->
                    <!-- BEGIN checkout-footer -->
                    <div class="checkout-footer text-center">
                        <button type="submit" class="btn btn-white btn-lg p-l-30 p-r-30 m-l-10">Manage Orders</button>
                    </div>
                    <!-- END checkout-footer -->
                </form>
            </div>
            <!-- END checkout -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #checkout-cart -->

@endsection

@section('extrajs')
    <script>

    </script>
@endsection
