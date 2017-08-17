<?php
     require_once('../init.php');
     header('Content-Type: application/json');
     
      ob_start();
      $sel = sprintf("SELECT ClientID,ServiceID FROM serviceRequest");
      
      $result = mysqli_query($db,$sel);
      $product = mysqli_query($db,$sql);
      
      $data = array();
      foreach($result as $row)
      {
        $id = $row['RequestID'];
        $assoc = mysqli_fetch_assoc($db,"SELECT ClientID,ServiceID FROM serviceRequest WHERE RequestID = '$id'");

        $data[] = $row;
      }
     
      ob_end_clean();
      mysqli_close($db);
      #print data
      print json_encode($data);
 ?>
