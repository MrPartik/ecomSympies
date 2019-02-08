<?php 

include_once('Config/Config.php');
include_once('Helpers/PayPalHelper.php');

$paypalHelper = new PayPalHelper;

$paymentData = array(
    "pay_id" => $_POST['pay_id'],
	"payer_id" => $_POST['payer_id']
);

if(array_key_exists('updated_shipping', $_POST)) {
    $finalTotal = $_POST['total_amt'] + ($_POST['updated_shipping'] - $_POST['current_shipping']);
    $paymentData['transactions'] = array(
        array(
            "amount" => array(
                "total" => $finalTotal,
                "currency" => $_POST['currency'],
                "details" => array (
                    "subtotal" => $_POST['item_amt'],
                    "tax" => $_POST['tax_amt'],
                    "shipping" => $_POST['updated_shipping'],
                    "handling_fee" => $_POST['handling_fee'],
                    "shipping_discount" => $_POST['shipping_discount'],
                    "insurance" => $_POST['insurance_fee']
                )
            )
        )
    );
    //var_dump($paymentData);
}

header('Content-Type: application/json');
echo json_encode($paypalHelper->paymentExecute($paymentData));