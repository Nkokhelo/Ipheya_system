<?php
  $logic = new Logic();
  $feedback = "";
  $method =  $logic->connect();

if(isset($_POST['add-trainer']))
{
    $name = $_POST['trainer-name'];
    $qualification = $_POST['qualification'];
    $address = $_POST['trainer-address'];
    $cell = $_POST['cell-number'];
    $type = $_POST['type'];
    
    $res = $method->query("INSERT INTO `trainer`(`trainerId`, `trainername`, `qualification`, `address`, `contact`, `trainertype`) VALUES (NULL,'$name','$qualification','$address','$cell','$type')");

    if($res)
    {
     $feedback = $logic->display_success("Trainer Added");
    }else
    {
     die("INSERT INTO `trainer`(`trainerId`, `trainername`, `qualification`, `address`, `contact`, `trainertype`) VALUES (NULL,'$name','$qualification','$address','$cell','$type')");
     $feedback = $logic->display_error("Could not add trainer. Try again");
    }
}
?>