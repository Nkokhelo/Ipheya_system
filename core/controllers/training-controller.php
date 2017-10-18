<?php
 $logic = new Logic();
 $connect = $logic->connect();
 $method = $logic->connect();
 $feedback = "";
 $alld = $allt ='';
 $deparmentslist = $logic->getallDepartments();
 while($deparments = $deparmentslist->fetch_assoc())
 {
   $alld .= "<option value='".$deparments['department_id']."'>".$deparments['department']."</option>";
 }
 $trainerslist = $logic->getallTrainers();
 while($trainers = $trainerslist->fetch_assoc())
 {
  // die(json_encode($trainers));
  
  $allt .= "<option value='".$trainers["trainerId"]."'>".$trainers["trainername"]."</option>";
}
 if(isset($_POST['add_training']))
 {
  $deparments = $_POST['department'];
  //declare
  $name = $s_date = $e_date = $venue = $description = "";
  $name = $_POST['training_name'];  
  $venue = $_POST['venue'];  
  $description = $_POST['description'];  
  $start_date = $_POST['start_date'];  
  $end_date = $_POST['end_date'];  

 $sql ="INSERT INTO `training` (`trainingId`, `tname`, `description`, `venue`, `startdate`, `enddate`) 
 VALUES (NULL, '{$name}', '{$description}', '{$venue}', '{$start_date}', '{$end_date}')";

 if(!$connect->query($sql))
 {
  $feedback = $logic->display_error("Error while saving");
  return TRUE;
 }
 $t_id = $connect->insert_id;
 for($x =0; $x < count($deparments); $x++)
 {
  
   $sql ="INSERT INTO `department_training`(`department_id`, `trainingId`)
   VALUES ($deparments[$x],$t_id)";
   if(!$connect->query($sql))
   {
    die($sql);
    $feedback = $logic->display_error("Error while posting to departments");
    return TRUE;
   }
 }
//trainer id 
$trainer_id = $_POST['trainerId'];
$sql ="INSERT INTO `trainer_training`(`trainerId`, `trainingId`)
VALUES ($trainer_id,$t_id)";
if(!$connect->query($sql))
{
 die($sql);
 $feedback = $logic->display_error("Error while posting to departments");
 return TRUE;
}
 $feedback = $logic->display_success("Added Successfully");
 }


 if(isset($_POST['add-test']))
 {
   $method = $logic->connect();
     $name = $_POST['test-name'];
     $date = $_POST['test-date'];
     $trainingid = $_POST['training-id'];

     $res = $method->query("INSERT INTO `test`(`test_id`, `training_id`, `test_name`, `test_date`) VALUES (NULL,'$trainingid','$name','$date')");
     if($res)
     {
       $feedback = $logic->display_success("Test Added");
     }else
     {
      $feedback = $logic->display_error("Could not add test. Try again");
      
     }
 }
?>