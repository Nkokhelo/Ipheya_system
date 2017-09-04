<?php
   require_once('/init.php');
   session_start();
   header('Content-Type: application/json');
   $par = $_SESSION['chat_employee'];
   #$par = 'Admin@gmail.com';

   $esql = mysqli_query($db, "SELECT emp_no, name, surname FROM employees WHERE email = '$par'");
   $er = mysqli_fetch_assoc($esql);
   $csql = mysqli_query($db, "SELECT name, surname FROM tc_account WHERE email = (SELECT client_email FROM chat WHERE employee_id = '$er[emp_no]')");
   $cr = mysqli_fetch_assoc($csql);
   $sql = mysqli_query($db, "SELECT * FROM message WHERE message_from = '$er[emp_no]' OR message_to = '$er[emp_no]' ");

   $data = '';

   while($message = mysqli_fetch_assoc($sql)):
     $time = $message['message_time'];
     $time = substr($message['message_time'],11,5);
     if($message['message_from']==$er['emp_no'])
     {
       $m = '<li class="left clearfix"><span class="chat-img pull-left">
                 <img src="http://placehold.it/50/0FBFB6/fff&amp;text='.substr($er['name'],0,1).substr($er['surname'],0,1).'" alt="User Avatar" class="img-circle">
             </span>
                 <div class="chat-body clearfix">
                     <div class="header">
                     <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$time.'</small>
                     <strong class="pull-left primary-font"></strong>
                     </div>
                     <p>
                        '.$message['message_body'].'
                     </p>
                     <!--<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$time.'</small>-->
                 </div>
             </li>';
     }
     else if($message['message_to']==$er['emp_no'])
     {
       $m = '<li class="right clearfix"><span class="chat-img pull-right">
             <img src="http://placehold.it/50/9F16CC/fff&amp;text='.substr($cr['name'],0,1).substr($cr['surname'],0,1).'" alt="User Avatar" class="img-circle">
         </span>
             <div class="chat-body clearfix">
                 <div class="header">
                     <strong class="primary-font">'.$cr['name'].' '.$cr['surname'].'</strong> <small class="pull-right text-muted">
                         <span class="glyphicon glyphicon-time"></span>'.$time.'</small>
                 </div>
                 <p>
                  '.$message['message_body'].'
                 </p>
             </div>
         </li>';
     }
     $data .= $m;
   endwhile;

   #print data
   print json_encode($data);
 ?>
