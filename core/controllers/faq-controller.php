<?php
# 21401824 ME Zenzile
$logic = new Logic();
$alldepartment='';
$all= $logic->getallDepartments(); 
$feedback="";
$faqs='';
$allf = $logic->getallfaqs();
$service_ratings='';
while($f = mysqli_fetch_assoc($allf))
{
  if($f['department_id']!=null)
  {
    $faqs.="<tr><td>".$f['question']."</td><td>Yes</td><td><a href='createfaq.php?faq=".$f['f_id']."'>Edit</a></td></tr>";
  }
  else
  {
    $faqs.="<tr><td>".$f['question']."</td><td>No</td><td><a href='createfaq.php?faq=".$f['f_id']."'>Answer</a></td></tr>";
  }
}

$ratequery ="SELECT service_id, AVG(rating) as rating FROM s_ratings GROUP BY service_id";
$result =mysqli_query($logic->connect(), $ratequery);
while($rate =mysqli_fetch_assoc($result))
{
  $stars ='';
  for($i=0; $i<5;$i++)
  {
    if($i< $rate['rating'])
    {
      $stars.="<div class='col-xs-1'><i class='fa fa-star'></i></div>";
    }
    else
    {
      $stars.="<div class='col-xs-1'><i class='fa fa-star-o'></i></div>";
    }
  }
  $service_ratings .="<div class='col-xs-3'> 
                      <h4>".$logic->getServiceNameByID($rate['service_id'])."</h4>
                      <div class='col-xs-12' style='color:blue'>".$stars."</div>
                      </div>";
}
if(isset($_GET['an']))
{
  $faqs=null;  
  $allf = $logic->getallfaqs();
  
  while($f = mysqli_fetch_assoc($allf))
  {
    if($f['department_id']!=null)
    {
      $faqs.="<tr><td>".$f['question']."</td><td>".$logic->getDepartmentById($f['department_id'])['department']."</td></tr>";
    }
  }
  
}
if(isset($_GET['u']))
{
  $faqs=''; 
  $allf = $logic->getallfaqs();
  
  while($f = mysqli_fetch_assoc($allf))
  {
    if($f['department_id']==null)
    {
      $faqs.="<tr><td>".$f['question']."</td><td>".$f['name']."</td><td>".$f['email']."</td></tr>";
    }
    
  }
  
}
while($dep = mysqli_fetch_assoc($all))
 {
   $alldepartment.="<option value='".$dep['department_id']."'>".$dep['department']."</option>";
 } 

 if(isset($_POST['save']))
 {
  //  die("Die");
  $saveQ ="UPDATE faqs SET `department_id`=".$_POST['d_id'].", `answer`='".$_POST['answer']."', `category`='".$_POST['cat']."' WHERE `f_id`=".$_POST['faq_id'];
  $query = mysqli_query($logic->connect(),$saveQ);
  if(!$query)
  {
    $feedback = $logic->display_error("Error".$saveQ);
  }
  else
  {
    $feedback = $logic->display_success("Saved");
    header("Location:allfaqs.php");
  }
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
     die($logic->sendEmail($_POST['name'],$_POST['email'],"Question submited",$logic->emailBody($_POST['name'],"Your question was recived by ipheya<br> It be answered soon!")));
     
   }
 }
 if(isset($_GET['faq']))
 {
    $FAQ = $logic->getfaqbyId($_GET['faq']);
 }


?>