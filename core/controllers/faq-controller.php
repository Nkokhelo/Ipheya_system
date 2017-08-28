<?php
$logic = new Logic();
$alldepartment='';
$all= $logic->getallDepartments(); 
$feedback="";
while($dep = mysqli_fetch_assoc($all))
 {
   $alldepartment.="<option value='".$dep['department_id']."'>".$dep['department']."</option>";
 } 

 if(isset($_POST['save']))
 {
  $feedback = $logic->display_success("Saved");
 }
 if(isset($_POST['submit']))
 {
   $saveQ ="INSERT INTO faqs(`name`,`email`,`question`) VALUES('".$_POST['name']."','".$_POST['email']."','".$_POST['message']."')";
   $query = mysqli_query($logic->connect(),$saveQ);
   if(!$query)
   {
     die("Error");
   }
   else
   {
     die($logic->sendEmail($_POST['name'],$_POST['email'],"Question submited","Your question was recived by ipheya"));
   }
 }
?>