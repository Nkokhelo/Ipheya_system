<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
$success ='';
$message ='';
if($_POST) 
{	

	$supplier_id = addslashes($_POST['supplier']);
	$order_date = date('Y-m-d', strtotime($_POST['orderdate']));	
	$expected_date = addslashes($_POST['expected_date']);
	$order_quantity = addslashes($_POST['order_quantity']);
	$order_vat =addslashes($_POST['vatValue']);
	$order_amount = $_POST['totalAmountValue'];
	$discount = $_POST['discount'];
	$amount_a_disc = $_POST['grandTotalValue'];
				
	$sql = "INSERT INTO `purchase_orders` (`order_id`, `supplier_id`, `order_date`, `expected_date`, `order_quantity`, `order_vat`, `order_amount`, `discount`, `amount_a_disc`, `status`) VALUES (null,$supplier_id, '$order_date', '$expected_date', '$order_quantity', '$order_vat', '$order_amount', '$discount', '$amount_a_disc', 0);";
	
	$order_id;
	$orderStatus = false;
	$success = false;
	if($connect->query($sql)==true) 
	{
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	
		$orderStatus = true;

		$productids = $_POST['productName'];
		$quantities = $_POST['quantity'];
		$unitprices = $_POST['unitprice'];
		$onhand = false;
		$success = false;
			for($x = 0; $x < count($productids); $x++) 
			{			
				$product_id	= $productids[$x];
				$quantity = $quantities[$x];
				$unitprice = $unitprices[$x];

				$query ="INSERT INTO `inventories` (`inventry_id`, `quantity`, `unit_price`, `product_id`, `order_id`, `is_on_hand`) 
				VALUES (NULL, $quantity, $unitprice, $product_id, $order_id, '0')";
				if($connect->query($query)==true)
				{
					$success = true;
					$message ="Purchase order was saved!";
				}else
				{
					$message ="Error".$connect->error." ".$query;					
				}
			} // /for quantity
	}
	else
	{
		$message ="Error".$connect->error;
	}

	$valid['success'] = $success;
	$valid['messages'] = $message;		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);