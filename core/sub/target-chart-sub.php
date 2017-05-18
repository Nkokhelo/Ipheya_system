<?php
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
