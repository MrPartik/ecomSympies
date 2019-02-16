<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
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
class paymentController extends Controller
{
    private $_api_context;
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
        $getProd = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('PROD_ID',$request->prodID)
            ->first();

        $totalPrice=($getProd->PROD_IS_APPROVED==1)?(($getProd->PROD_REBATE/100)* $getProd->PROD_BASE_PRICE)
        +(($getProd->rTaxTableProfile->TAXP_TYPE==0)?($getProd->rTaxTableProfile->TAXP_RATE/100)* $getProd->PROD_BASE_PRICE:($getProd->rTaxTableProfile->TAXP_RATE)+ $getProd->PROD_BASE_PRICE)
        +(($getProd->PROD_MARKUP/100)* $getProd->PROD_BASE_PRICE)+$getProd->PROD_BASE_PRICE:'NAN';
        $discount = $getProd->PROD_DISCOUNT;
        $total =($discount)?$totalPrice-($totalPrice*($discount/100)):$totalPrice;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($getProd->PROD_NAME) /** item name **/
        ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($total) /** unit price **/
            ->setSku($getProd->PROD_CODE)
            ->setDescription($getProd->PROD_DESC);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
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
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }


    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
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

            Session::put('payment_success', 'Payment success');
            return Redirect::to('/');
        }
        Session::put('payment_error', 'Payment failed');
        return Redirect::to('/');
    }

    public  function refundTransaction(Request $request){

        $refund = new Refund();
    }
}
