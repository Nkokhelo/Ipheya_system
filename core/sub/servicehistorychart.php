<?php
    require_once('../init.php');
    require('../logic.php');
    $logic = new Logic();
    header('Content-Type: application/json');
    $data='';
    //  ob_start();
    if(isset($_GET['client']))
    {
       $id =$_GET['client'];
      //  $sel = sprintf("SELECT ClientID,ServiceID FROM serviceRequest");
       $view ="SELECT COUNT(servicerequest.RequestID) AS num_req , servicerequest.ServiceID FROM servicerequest WHERE servicerequest.ClientID=".$id." GROUP BY servicerequest.ServiceID";
 
       $result = mysqli_query($db,$view);
       
       $data = '[';
       while($row = mysqli_fetch_assoc($result))
       {
         $data .='{"req_count":"'.$row['num_req'].'","service_name":"'.$logic->getServiceNameByID($row['ServiceID']).'"},';
       }
       $data =rtrim($data,",");
       $data .=']';
       echo $data;
      //  ob_end_clean();
       mysqli_close($db);
       #print data
    }
 ?>
