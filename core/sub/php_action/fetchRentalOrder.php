<?php 	

require_once 'core.php';
include("../../logic.php");
$log = new Logic();

$sql = "SELECT cr.client_rental as order_id, p.product_name as name, cr.quantity, cr.pickup_date, cr.return_date, cr.total_amount FROM client_rentals as cr JOIN rentals as r ON r.rental_id =  cr.rental_id JOIN inventories as i on i.inventry_id = r.inventory_id JOIN product as p on p.product_id = i.product_id";

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
    <li><a type="button" data-toggle="modal" id="viewRental" data-target="#editProductModal" onclick="viewRentalOrder('.$order["order_id"].')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["order_id"].')"> <i class="glyphicon glyphicon-ok-sign"></i> Cofirm order</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["order_id"].')"> <i class="glyphicon glyphicon-thumbs-down"></i> Decline order</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["order_id"].')"> <i class="glyphicon glyphicon-ok-circle"></i> Mark as returned</a></li>
  </ul>
</div>';

 	$output['data'][] = array( 		
			//order id
			$order['order_id'],
			// product name
 		$order['name'],
 		// quantity
 		$order['quantity'], 
 		// pickup date
			date_format(date_create($order['pickup_date']),"d F Y-l"), 
			//return date 	
			date_format(date_create($order['return_date']),"d F Y-l"), 
			// total price
			number_format($order['total_amount'],2,","," "),
			// button
 		$button 		
 		); 	
	}

}// if num_rows

$connect->close();

echo json_encode($output);

?>