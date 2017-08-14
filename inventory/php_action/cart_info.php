<?php
$currency = 'R'; //Currency Character or code


$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'sales';
$db_host 		= 'localhost';

//paypal details FROM PAYMENT USECASE
$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'account@gmail.com'; //PayPal API Username
$PayPalApiPassword 		= '979797979'; //Paypal API password
$PayPalApiSignature 	= 'AewouidSeoiewDradoZcgqH3hpacAokIiuNjAwoiedkew'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://yoursite.com/php-shopping-cart-master/paypal-express-checkout/'; //Point to paypal-express-checkout page
$PayPalCancelURL 		= 'http://yoursite.com/shopping-cart/paypal-express-checkout/cancel_url.html'; //Cancel URL if user clicks cancel

//Additional taxes and fees
//$HandalingCost 		= 0.00;  //Handling cost for the order.
//$InsuranceCost 		= 0.00;  //shipping insurance cost for the order.
$shipping_cost      = 0.00; //shipping cost
$ShippinDiscount 	= 0.00; //Shipping discount for this order. Specify this as negative number (eg -1.00)
$taxes              = array( //List your Taxes percent here.
                            'VAT' => 2,
                                                  );



//connection to MySql
$mysqli = new mysqli("localhost","root","","sales");
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>
