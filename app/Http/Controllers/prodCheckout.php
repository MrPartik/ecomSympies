<?php

namespace App\Http\Controllers;
include_once(asset('api/Config/Config.php'));
include_once(asset('Helpers/PayPalHelper.php'));

use Illuminate\Http\Request;

class prodCheckout extends Controller
{

    public function createPayment(Request $request){


        $paypalHelper = new PayPalHelper;



        $paymentData = array(
            "intent" => "sale",
            "payer" => array(
                "payment_method" => "paypal"
            ),
            "transactions" => array(
                array(
                    "amount" => array(
                        "total" => $_POST['total_amt'],
                        "currency" => $_POST['currency'],
                        "details" => array (
                            "subtotal" => $_POST['item_amt'],
                            "tax" => $_POST['tax_amt'],
                            "shipping" => $_POST['shipping_amt'],
                            "handling_fee" => $_POST['handling_fee'],
                            "shipping_discount" => $_POST['shipping_discount'],
                            "insurance" => $_POST['insurance_fee']
                        )
                    )
                )
            ),
            "redirect_urls" => array(
                "return_url" => $_POST['return_url'],
                "cancel_url" => $_POST['cancel_url']
            )
        );

        if(array_key_exists('shipping_country_code', $_POST)) {
            $paymentData['transactions'][0]['item_list'] = array(
                "shipping_address" => array(
                    "recipient_name" => $_POST['shipping_recipient_name'],
                    "line1" => $_POST['shipping_line1'],
                    "line2" => $_POST['shipping_line2'],
                    "city" => $_POST['shipping_city'],
                    "state" => $_POST['shipping_state'],
                    "postal_code" => $_POST['shipping_postal_code'],
                    "country_code" => $_POST['shipping_country_code']
                )
            );
        }

        header('Content-Type: application/json');
        echo json_encode($paypalHelper->paymentCreate($paymentData));
    }
}
