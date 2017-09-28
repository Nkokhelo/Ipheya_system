<?php

require_once 'core.php';
include("../../logic.php");
$log = new Logic();

$sql = "SELECT * FROM inventories WHERE is_on_hand = 1";
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) 
{

 while($row = $result->fetch_array()) {
  $i_id = $row['inventry_id'];
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	     <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#salesModal" onclick="sellProduct('.$i_id.')"> <i class="fa fa-money"></i> Sell Product</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#rentalModal" onclick="lease('.$i_id.')"> <i class="fa fa-handshake-o"></i> Lease Product</a></li>
	  </ul>
	</div>';

 	$output['data'][] = array(
   $log->getProduct($row['product_id'])['product_name'],
   number_format($row['unit_price'],2,","," "),
   number_format($row['quantity'],0,","," "),
   number_format(($row['quantity']*$row['unit_price']),2,","," "),
   $button
 		);
 } // /while

} // if num_rows

$connect->close();

echo json_encode($output);
