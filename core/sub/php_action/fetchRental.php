<?php 	

require_once 'core.php';
include("../../logic.php");
$log = new Logic();

$sql = "SELECT r.rental_id, p.product_name, r.quantity, r.product_deposit FROM rentals as r JOIN inventories as i ON i.inventry_id = r.inventory_id JOIN product as p ON p.product_id = i.product_id";

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
    <li><a type="button" data-toggle="modal" id="viewRental" data-target="#editProductModal" onclick="viewRentalOrder('.$order["rental_id"].')"><i class="glyphicon glyphicon-eye-open"></i> View</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["rental_id"].')"> <i class="glyphicon glyphicon-ok-sign"></i> Cofirm order</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["rental_id"].')"> <i class="glyphicon glyphicon-thumbs-down"></i> Decline order</a></li>
  </ul>
</div>';

  $sql1 = "SELECT t.timeline FROM timeline_rental as tr JOIN timelines as t ON t.timeline_id = tr.timeline_id WHERE tr.rental_id =". $order['rental_id'];
  $options ="";
  if($connect->query($sql1)==true)
  {
   $result1 = $connect->query($sql1);
   while($timelines = $result1->fetch_assoc())
   {
     $options .= $timelines['timeline'].", ";
   }
   if($options != "")
   {
    $options = rtrim($options,", ");
   }
  }

 	$output['data'][] = array( 		
			//order id
			$order['rental_id'],
			// product name
 		$order['product_name'],
 		// quantity
 		$order['quantity'], 
 		// pickup date
			$order['product_deposit'], 
			//Chages options 	
			$options,
			// button
 		$button 		
 		); 	
	}

}// if num_rows

$connect->close();

echo json_encode($output);

?>