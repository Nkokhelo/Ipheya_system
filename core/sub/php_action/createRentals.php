<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'rental_id' => '');
$success ='';
$message ='';

if($_POST) 
{
	 $inventory_id = $_POST['inventoryId'];
  $depostiAmount = $_POST['depostiAmount'];
  $quantity = $_POST['quantity'];

  $timeline_id = $_POST['timeline'];
  $charge = $_POST['charge'];
  $penalty = $_POST['penalty'];
  for($x =0; $x < count($timeline_id); $x++)
  {
   $message .="Timeline ".$timeline_id[$x];
  }
  //arrays
  
  $sql = "INSERT INTO `rentals` (`rental_id`, `inventory_id`, `product_deposit`, `quantity`) VALUES (NULL, $inventory_id, $depostiAmount, $quantity);";
  
  if($connect->query($sql)==true)
  {
   $timeline_ids = $_POST['timeline'];
   $charges = $_POST['charge'];
   $penalties = $_POST['penalty'];

   $success = false;
   $rental_id = $connect->insert_id;
   $valid['rental_id'] = $rental_id;
   
			for($x = 0; $x < count($timeline_ids); $x++) 
			{
        $timeline_id	= $timeline_ids[$x];
        $charge = $charges[$x];
        $penalty = $penalties[$x];
        $query ="INSERT INTO `timeline_rental` (`tr_id`, `timeline_id`, `rental_id`, `rental_charge`, `penalty`) 
        VALUES (NULL, $timeline_id, $rental_id, $charge, $penalty);";
        if($connect->query($query)==true)
        {
          $sql = "UPDATE `inventories` set `quantity` = `quantity`- $quantity WHERE `inventry_id`=$inventory_id";
          if($connect->query($sql)==true)
          {
          $success = true;
          $message ="Rental item was saved!";
          }
          else
          {
          $message ="Error! Occured ";
          }
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
 $valid['message'] = $message;

 $connect->close();
 
 echo json_encode($valid);
}


