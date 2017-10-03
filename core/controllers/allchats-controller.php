<?php
 $feedback ='';
 $logic = new Logic();
 $con = $logic->connect();
 $sql = "SELECT * FROM employees";
 $result = $con->query($sql);
 $chatlist='';
 if(!$result)
 {
    $feedback = $logic->display_error("Error occured");
    return false;
 }
 while($employee = $result->fetch_assoc())
 {
  $button = "<button class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick='call()'><i class='fa fa-phone'></i> Call</button>";
  $chatlist .='<tr> <td>'.$employee["name"].' '.$employee["surname"].'</td> <td>'.$employee["email"].'</td> <td>'.$employee["phone_number"].'</td> <td>'.$button.'</td> </tr>';
 }
?>