
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
    Route::get('/grossSalesJSON','manageSales@grossSalesJSON');
    Route::get('/salesJSON','manageSales@SalesJSON');


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
Route::post('/loginSympiesAccount','sympiesUser@loginUser');


Route::get('/logoutSympiesAccount/{id}',function($id){

    $get = Session::get('sympiesAccount');
    if($get['ID']==$id)
        Session::forget('sympiesAccount');
    return redirect()->back();
});

Route::get('/mail','mailer@sendEmailReminder');


Route::get('/getAllCategories',function(){
   $prodcat = \Illuminate\Support\Facades\DB::SELECT('SELECT parent.PRODT_TITLE category
,SUM(((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE=\'CAPITAL\' OR INV.INV_TYPE=\'ADD\') AND INV.PROD_ID=PROD.PROD_ID)
+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE=\'DISPOSE\' AND INV.PROD_ID=PROD.PROD_ID)
+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE=\'ORDER\' AND INV.PROD_ID=PROD.PROD_ID)
+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
+(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_product_infos t_infos WHERE PROD_ID = PROD.PROD_ID))) quantity
,parent.PRODT_ICON categoryimage
FROM r_product_types parent
INNER JOIN r_product_types child ON parent.PRODT_ID = child.PRODT_PARENT
INNER JOIN r_product_infos PROD ON child.PRODT_ID = PROD.PRODT_ID
GROUP BY parent.PRODT_TITLE,parent.PRODT_ICON');


    return json_encode(array('feedcontent'=>$prodcat));
});

Route::get('/getAllProducts',function (){
    return \App\Providers\sympiesProvider::filterAvailable(\App\r_product_info::with('rAffiliateInfo', 'rProductType')
        ->where('PROD_IS_APPROVED', '1')
        ->where('PROD_DISPLAY_STATUS', 1)->get());
});

Route::get('/search','frontProductsController@search');
