<?php

include_once('Config/Config.php');
include_once('Helpers/PayPalHelper.php');

$paypalHelper = new PayPalHelper;

$paymentData = array(
    "pay_id" => $_POST['pay_id']
);

header('Content-Type: application/json');
echo json_encode($paypalHelper->paymentGet($paymentData));