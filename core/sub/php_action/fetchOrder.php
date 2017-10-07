<?php 	

require_once 'core.php';
include("../../logic.php");
$log = new Logic();

$sql = "SELECT i.product_id as p_id ,po.order_id as o_id, po.supplier_id as s_id,po.order_date as od, po.expected_date as ed, i.quantity as q, i.unit_price as up, i.inventry_id as i_id FROM inventories AS i JOIN purchase_orders AS po ON po.order_id = i.order_id WHERE is_on_hand = 0 ";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) 
{ 
	
	while($order = $result->fetch_assoc())
 {
  $button ='<div class="btn-group">
  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-caret-down"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="addInventory('.$order["i_id"].')"> <i class="glyphicon glyphicon-edit"></i> Add to inventory</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["i_id"].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
  </ul>
</div>';

 	$output['data'][] = array( 		
			// supplier name
			$log->getSupplierName($order['s_id']),
			// product name
 		$log->getProduct($order['p_id'])['product_name'],
 		// order date
 		date_format(date_create($order['ed']),"d-M-y"), 
 		// unit price
			number_format($order['up'],0,","," "), 
			// quantity		 	
			number_format($order['q'],2,","," "),
			// vat 14%
 		number_format(($order['q']*$order['up'])*14/100,2,","," "),
			// total Amount
			number_format(($order['q']*$order['up'])-(($order['q']*$order['up'])*14/100),2,","," "),

 		$button 		
 		); 	
	}

}// if num_rows

$connect->close();

echo json_encode($output);
?>