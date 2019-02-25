<?php
namespace App\Http\Controllers;
use App\t_product_variance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\ShippingAddress;
use PayPal\Api\ShippingInfo;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Refund;
use Redirect;
use Session;
use URL;
use App\r_product_info;
use App\r_product_type;
use App\r_tax_table_profile;
use App\Providers\sympiesProvider as Sympies;
class paymentController extends Controller
{
    private $_api_context
        ,$prodID =0
        ,$prodvID = 0
        ,$qty = 0
        ,$prodName = ""
        ,$prodCode =""
        ,$prodDesc =""
        ,$percentage =0
        ,$fixed = 0
        ,$taxed = 0
        ,$taxRate=0
        ,$subtotal=0
        ,$sellingPrice =0
        ,$prodPrice =0
        ,$currency = ""
        ,$delivery = 0;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function payWithpaypal(Request $request)
    {
        $prodID = $request->prodID;
        $prodvID = $request->prodvID;
        $qty = $request->qty;
        $percentage = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==0)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0;
        $fixed = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==1)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0;
        $currency = 'USD';
        $delivery = Sympies::active()->SET_DEL_CHARGE;

        if($prodvID==0){
            $getProd = r_product_info::with('rAffiliateInfo','rProductType')
                ->where('PROD_IS_APPROVED','1')
                ->where('PROD_DISPLAY_STATUS',1)
                ->where('PROD_ID',$prodID)
                ->first();
            $prodCode = $getProd->PROD_CODE;
            $prodDesc = $getProd->PROD_DESC;
            $prodPrice = $getProd->PROD_MY_PRICE;
            $discount = $getProd->PROD_DISCOUNT;
            $prodName = $getProd->PROD_NAME;
            $sellingPrice = ($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice;
            $subtotal = (($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice)* $qty;
            $sellingPrice =  $sellingPrice * $qty;
            $taxed = ($percentage==0)?$sellingPrice+$fixed:($sellingPrice + ($sellingPrice*($percentage/100)));
            $taxRate = ($percentage==0)?$fixed:(($sellingPrice*($percentage/100)));
            $sellingPrice = $taxed;
        }else{
            $getProdv = t_product_variance::with('rProductInfo')
                ->where('PROD_ID',$prodID)
                ->where('PRODV_ID',$prodvID)
                ->first();

            $prodCode = $getProdv->PRODV_SKU;
            $prodDesc = $getProdv->PRODV_DESC;
            $discount = $getProdv->rProductInfo->PROD_DISCOUNT;
            $prodPrice = $getProdv->PRODV_ADD_PRICE + $getProdv->rProductInfo->PROD_MY_PRICE;
            $prodName = $getProdv->PRODV_NAME;
            $sellingPrice = ($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice;
            $subtotal = (($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice)* $qty;
            $sellingPrice =  $sellingPrice * $qty;
            $taxed = ($percentage==0)?$sellingPrice+$fixed:($sellingPrice + ($sellingPrice*($percentage/100)));
            $taxRate = ($percentage==0)?$fixed:(($sellingPrice*($percentage/100)));
            $sellingPrice = $taxed;

        }
        $sellingPrice = $sellingPrice+$delivery;


        $payer = new Payer();
        $details = new Details();
        $amount = new Amount();
        $item_list = new ItemList();
        $redirect_urls = new RedirectUrls();
        $transaction = new Transaction();
        $payment = new Payment();

        //payment
        $payer
            ->setPaymentMethod('paypal');

        //item it should be array, if cart use foreach init Item() in every succeeding item in cart
        $item_1 = new Item();
        $item_1
            ->setName($prodName) /** item name **/
            ->setCurrency($currency)
            ->setQuantity($qty)
            ->setPrice($sellingPrice) /** unit price **/
            ->setSku($prodCode)
            ->setDescription($prodDesc);

        //item list
        $item_list
            ->setItems(array($item_1));

        // Details
//        $details
//            ->setShipping($delivery)
//            ->setTax($taxRate)
//            ->setSubtotal($subtotal)
//            ->setShippingDiscount('0.00')
//            ->setFee('0.00')
//            ->setInsurance('0.00')
//            ->setGiftWrap('0.00')
//            ->setHandlingFee('0.00');

        //amount
        $amount
            ->setCurrency($currency)
            ->setTotal($sellingPrice);

        //transaction
        $transaction
            ->setAmount($amount)
            ->setItemList($item_list)
            ->setInvoiceNumber(uniqid('SYMPIES-'))
            ->setDescription($request->prodnote);

        //redirect url's
        $redirect_urls
            ->setReturnUrl(URL::to('checkout/finished')) /** Specify return URL **/
            ->setCancelUrl(URL::to('/'));

        //set intent *sale *order *authorize
        $payment
            ->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {
            //create payment
            $payment
                ->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }




    public function getPaymentStatus()
    {
        $Allprod = Sympies::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)->get());

        $Allprod = Sympies::format($Allprod);


        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
//        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            Session::put('payment_failed', 'Payment failed');
            return Redirect::to('/');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));


        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $info = $result->getPayer()->getPayerInfo();
            Session::put('payment_success', 'Payment success');

            return view('pages.frontend-shop.checkout_complete',compact('info','Allprod','result','prodID','prodvID'));
        }
        Session::put('payment_error', 'Payment failed');
        return Redirect::to('/');
    }


    public  function refundTransaction(Request $request){

        $refund = new Refund();
    }
}
