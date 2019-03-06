<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::group(['middleware' => ['authenticate']], function() {

    Route::group(['middleware' => ['isAdmin']], function(){

        Route::resource('/product/category', 'manageProductCategory',['names'=>['index'=>'prodCat','create'=>'prodCat','edit'=>'prodCat']]);
        Route::resource('/tax', 'manageTax',['names'=>['index'=>'tax','create'=>'tax','edit'=>'tax']]);
        Route::resource('/users', 'manageUsers',['names'=>['index'=>'users','create'=>'users','edit'=>'users']]);
        Route::resource('/affiliates', 'manageAffiliates',['names'=>['index'=>'affiliates','create'=>'affiliates','edit'=>'affiliates']]);
        Route::get('/product/category/create/{type}','manageProductCategory@create')->name('prodCat');
        Route::post('/tax/actDeact','manageTax@actDeact');
        Route::resource('/currency','manageCurrency',['names'=>['index'=>'currency','create'=>'currency','edit'=>'currency']]);

    });


    Route::post('/product/actDeact','manageProduct@actDeact');
    Route::post('/product/appDisapprove','manageProduct@appDisapprove');
    Route::post('/product/ProductVar','manageProduct@ProductVar');
    Route::get('/product/showProductVar/{id}','manageProduct@showProductVar');
    Route::post('/product/discount','manageProduct@updateDiscount');
    Route::post('/product/deleteAllProductVar','manageProduct@deleteAllProductVar');
    Route::post('/category/actDeact','manageProductCategory@actDeact');
    Route::post('/affiliate/actDeact','manageAffiliates@actDeact');
    Route::post('/user/actDeact','manageUsers@actDeact');


    Route::resource('/dashboard', 'manageDashboard',['names'=>['index'=>'dashboard','create'=>'dashboard','edit'=>'dashboard']]);
    Route::resource('/product/list', 'manageProduct',['names'=>['index'=>'prodList','create'=>'prodList','edit'=>'prodList']]);
    Route::resource('/order','manageOrder',['names'=>['index'=>'order','create'=>'order','edit'=>'order']]);

    Route::get('/sales','manageSales@sales');


//    Route::get('order-pending','manageOrder@index');
//    Route::get('order-complete','manageOrder@index');
//    Route::get('order-cancel','manageOrder@index');
//    Route::get('order-refund','manageOrder@index');
//    Route::get('order-void','manageOrder@index');
    Route::get('orders','manageOrder@index');

    Route::get('inventory-remaining','manageInventory@index');
    Route::get('inventory-manage','manageInventory@manageInventory');
    Route::get('inventory-remaining/{sku}','manageInventory@skuInventory')->name('sku');

    Route::post('inventory-acquire/product','manageInventory@productAcquire');
    Route::post('inventory-dispose/product','manageInventory@productDispose');

    Route::post('inventory-acquire/variance','manageInventory@productVAcquire');
    Route::post('inventory-dispose/variance','manageInventory@productVDispose');




});
Route::get('/getProd/Affiliates/{id}','frontProductsController@getProdAffiliates');
Route::get('/getProd/Category/{id}','frontProductsController@getProdCategory');
Route::get('/product/details/{id}','frontProductsController@getProdDetails');
Route::get('/summary-orders','frontProductsController@getOrders');

Route::group(['middleware'=> ['isSympiesUser']],function(){

        // route for processing payment
        Route::post('/checkout/execute', 'paymentController@payWithpaypal');
        // route for check status of the payment
        Route::get('/checkout/finished', 'paymentController@getPaymentStatus');
        //route for ordering process
        Route::post('/makeOrder', 'orderingFunctions@makeOrder');


});

Route::get('/get/user-invoice/{id}',function($id){
    $order = \App\t_order::where('ORD_ID',$id)
        ->first();

    $order_items = \App\t_order_item::with('tOrder','rProductInfo')
        ->where('ORD_ID',$order->ORD_ID)
        ->get();

    $invoice = \App\t_invoice::with('tOrder')
        ->where('ORD_ID',$order->ORD_ID)
        ->first();

    $shipment = \App\t_shipment::with('tInvoice','tOrder')
        ->where('ORD_ID',$order->ORD_ID)
        ->first();

    $payment = \App\t_payment::with('tInvoice')
        ->where('INV_ID',$invoice->INV_ID)
        ->first();

    return view('pages.invoices.user-invoice'
        ,compact('order','order_items','invoice','shipment','payment','product','product_variances'));
});


Route::resource('/','frontProductsController');

Route::post('/loginSympiesAccount',function(\Illuminate\Http\Request $request){

    $login = 'http://localhost/zax/getLogin.php';
    $profile = 'http://localhost/zax/getProfileDetails.php';

    $actor = $request->actor;
    $password = $request->password;


    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $login);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$actor&&password=$password");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $login = curl_exec($ch);
    curl_close($ch);

    if($login=='true') {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $profile);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "actor=$actor");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    $result = $result->profiledetails[0];
        $account = Array(
            "ID" => $result->rac_accountid,
            "NAME" => $result->rac_username,
            "CONTACT_NO" => $result->rac_pnumb,
            "HOME_ADDRESS" => "",
            "EMAIL" => $result->rac_email,
        );
        $get = Session::get('sympiesAccount');
        Session::put('sympiesAccount', $account);
    }

    return $login;

});

Route::get('/logoutSympiesAccount/{id}',function($id){

    if(Session::get('sympiesAccount')['ID'] == $id)
        Session::forget('sympiesAccount');
    return redirect()->back();
});



