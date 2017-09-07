<?php
 $logic = new Logic();
 $email =$_SESSION['Client'];
 $sql = "SELECT meeting_id, m_title, email, m_start, m_end, color FROM meetings where email = '$email'";
 $req = mysqli_query($db,$sql);
 $feedback="";
 $notify="";
 $sql = "SELECT `name`,`email`,`meeting_id` FROM meetings WHERE is_notified=false";
 $query = mysqli_query($db,$sql);
 if ($query == false)
 {
    $feedback = $logic->display_error("Error!! ".mysqli_error($db));
 }
 else
 {
   while($clients = mysqli_fetch_assoc($query))
   {
     $notify .="<tr><td>".$clients['name']."</td><td><form method='post' action=''><input type='hidden' name='event_id' value='".$clients['meeting_id']."'/><button class='btn btn-primary' name='yes_send'>Notify</button></form></td></tr>";
   }
 }
 if(isset($_POST['title']) && isset($_POST['description'])&& isset($_POST['start']) && isset($_POST['end']))
 {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = "#888";
    $description = $_POST['description'];
    $sql = "INSERT INTO meetings(email, m_title, m_description, m_start, m_end, color, is_client) values ('$email', '$title', '$description', '$start','$end','$color', true)";
    $query = mysqli_query($db,$sql);
    if ($query == false)
    {
       $feedback = $logic->display_error("Error!! ".mysqli_error($db));
    }
    else
    {
      $feedback = $logic->display_success("Your request was successfull, you will be notified when ther are changes on your request");
    }
 }

 if(isset($_POST['yes_send']))
 {
   $id= $_POST['event_id'];
   $name =$_POST['name'];
   $email =$_POST['email'];
   $meetingdate = $_POST['date'];
   $meetingdate = date_format(date_create($meetingdate),"l h:i  d F Y ") ;
  //  die($meetingdate);
   $sql = "UPDATE meetings set is_notified=true WHERE meeting_id=$id";
   $query = mysqli_query($db,$sql);
   if ($query == false)
   {
      $feedback = $logic->display_error("Error!! ".mysqli_error($db));
   }
   else
   {
     $logic->sendEmail($name,$email,"Meeting Scheduled",$logic->emailBody($name,"Your meeting was scheduled to ".$meetingdate));
     $sql = "SELECT `name`,`email`,`meeting_id`,`m_start` FROM meetings WHERE is_notified=false";
     $query = mysqli_query($db,$sql);
     if ($query == false)
     {
        $feedback = $logic->display_error("Error!! ".mysqli_error($db));
     }
     else
     {
       $notify="";
       while($clients = mysqli_fetch_assoc($query))
       {
         $notify .="<tr><td>".$clients['name']."</td><td><form method='post' action=''><input type='hidden' name='event_id' value='".$clients['meeting_id']."'/>
         <input type='hidden' id='inputname' name='name' value='".$clients['name']."'/>
         <input type='hidden' id='email'name='email'  value='".$clients['email']."'/>
         <input type='hidden' id='date'name='date' value='".$clients['m_start']."' /><button class='btn btn-primary' name='yes_send'>Notify</button></form></td></tr>";
       }
     }
     $feedback = $logic->display_success("Client has been notofied.");
   }
 }
 if(isset($_POST['not_now']))
 {
   $notify="";
   $sql = "UPDATE meetings set is_notified=false";
   $query = mysqli_query($db,$sql);
   if ($query == false)
   {
      $feedback = $logic->display_error("Error!! ".mysqli_error($db));
   }
   else
   {
     $sql = "SELECT `name`,`email`,`meeting_id` FROM meetings WHERE is_notified=false";
     $query = mysqli_query($db,$sql);
     if ($query == false)
     {
        $feedback = $logic->display_error("Error!! ".mysqli_error($db));
     }
     else
     {
       while($clients = mysqli_fetch_assoc($query))
       {
         $notify .="<tr><td>".$clients['name']."</td><td><form method='post' action=''><input type='hidden' name='event_id' value='".$clients['meeting_id']."'/><button class='btn btn-primary' name='yes_send'>Notify</button></form></td></tr>";
       }
     }
     $feedback = $logic->display_info("Your responce was <b>not now</b>, please use the left box to notify your client anytime later");
   }
 }
?>
