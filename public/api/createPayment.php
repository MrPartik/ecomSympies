<?php

include_once('Config/Config.php');
include_once('Helpers/PayPalHelper.php');

$paypalHelper = new PayPalHelper;

$getProd = r_product_info::with('rAffiliateInfo','rProductType','rTaxTableProfile')
    ->where('PROD_IS_APPROVED','1')
    ->where('PROD_DISPLAY_STATUS',1)
    ->where('PROD_ID',$request->PROD_ID)
    ->first();

$total=($getProd->PROD_IS_APPROVED==1)?(($getProd->PROD_REBATE/100)* $getProd->PROD_BASE_PRICE)
    +(($getProd->rTaxTableProfile->TAXP_TYPE==0)?($getProd->rTaxTableProfile->TAXP_RATE/100)* $getProd->PROD_BASE_PRICE:($getProd->rTaxTableProfile->TAXP_RATE)+ $getProd->PROD_BASE_PRICE)
    +(($getProd->PROD_MARKUP/100)* $getProd->PROD_BASE_PRICE)+$getProd->PROD_BASE_PRICE:'NAN';

$tax = (($getProd->rTaxTableProfile->TAXP_TYPE==0)?($getProd->rTaxTableProfile->TAXP_RATE/100)* $getProd->PROD_BASE_PRICE:($getProd->rTaxTableProfile->TAXP_RATE)+ $getProd->PROD_BASE_PRICE);

$price = number_format(($discount = $getProd->PROD_DISCOUNT)?$total-($total*($discount/100)):$total,2);

$paymentData = array(
    "intent" => "sale",
    "payer" => array(
        "payment_method" => "paypal"
    ),
    "transactions" => array(
        array(
            "amount" => array(
                "total" => $price,
                "currency" => 'PHP',
                "details" => array (
                    "subtotal" => $price,
                    "tax" => $tax,
                    "shipping" => 20,
                    "handling_fee" =>0,
                    "shipping_discount" => 0,
                    "insurance" => 0
                )
            )
        )
    ),
    "redirect_urls" => array(
        "return_url" => url('/'),
        "cancel_url" => url('/')
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
