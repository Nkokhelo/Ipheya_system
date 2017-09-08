<?php
     #21539288 POLELA AL
     require_once('../init.php');
     header('Content-Type: application/json');
      #query to retreive data
      ob_start();
      $query = sprintf("SELECT * FROM targets");
      #execute query
      $result = mysqli_query($db,$query);
      $product = mysqli_query($db,$sql);
      #loop through the results
      $data = array();
      foreach($result as $row)
      {
        $id = $row['target_id'];
        $dep = mysqli_fetch_assoc($db,"SELECT * FROM target_clients WHERE target_id = '$id'");

        $data[] = $row;
      }
      #free memory associated with result
      #mysqli_close($result);
      ob_end_clean();
      #close connection
      mysqli_close($db);
      #print data
      print json_encode($data);
 ?>
