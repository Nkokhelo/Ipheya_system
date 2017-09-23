<?php
 $log = new Logic();
 $connect = $log->connect();
 $query ="SELECT * FROM suppliers";
 $result =$connect->query($query);
 $option ='';
 while($suppliers = $result->fetch_assoc())
 {
  $option .="<option value='".$suppliers['supplier_id']."'>".$suppliers['company_name']."</option>";
 }
 
?>