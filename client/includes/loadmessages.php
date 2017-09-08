<?php
   #21539288 POLELA AL
   require_once($_SERVER['DOCUMENT_ROOT'].'/ipheya/core/init.php');
   session_start();
   header('Content-Type: application/json');
   $par = $_SESSION['chat_client'];

   $usql = mysqli_query($db, "SELECT name, surname FROM tc_account WHERE email = '$par'");
   $ur = mysqli_fetch_assoc($usql);
   $esql = mysqli_query($db, "SELECT name, surname FROM employees WHERE emp_no = (SELECT employee_id FROM chat WHERE client_email = '$par')");
   $er = mysqli_fetch_assoc($esql);
   $sql = mysqli_query($db, "SELECT * FROM message WHERE message_from = '$par' OR message_to = '$par' ");

   $data = '<li class="left" clearfix"><span class="chat-img pull-left">
         <img src="http://placehold.it/50/55C1E7/fff&amp;text='.substr($er['name'],0,1).substr($er['surname'],0,1).'" alt="User Avatar" class="img-circle">
     </span>
         <div class="chat-body clearfix">
             <div class="header">
                 <strong class="primary-font">'.$er['name'].' '.$er['surname'].'</strong> <small class="pull-right text-muted">
                     <span class="glyphicon glyphicon-time"></span>-- --</small>
             </div>
             <p>
               Welcome to live support how can we be of assistance?
             </p>
         </div>
     </li>';

   while($message = mysqli_fetch_assoc($sql)):
     $time = $message['message_time'];
     $time = substr($message['message_time'],11,5);
     if($message['message_from']==$par)
     {
       $m = '<li class="right clearfix"><span class="chat-img pull-right">
                 <img src="http://placehold.it/50/FA6F57/fff&amp;text='.substr($ur['name'],0,1).substr($ur['surname'],0,1).'" alt="User Avatar" class="img-circle">
             </span>
                 <div class="chat-body clearfix">
                     <div class="header">
                     <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$time.'</small>
                     <strong class="pull-right primary-font"></strong>
                     </div>
                     <p>
                        '.$message['message_body'].'
                     </p>
                     <!--<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$time.'</small>-->
                 </div>
             </li>';
     }
     else if($message['message_to']==$par)
     {
       $m = '<li class="left" clearfix"><span class="chat-img pull-left">
             <img src="http://placehold.it/50/55C1E7/fff&amp;text='.substr($er['name'],0,1).substr($er['surname'],0,1).'" alt="User Avatar" class="img-circle">
         </span>
             <div class="chat-body clearfix">
                 <div class="header">
                     <strong class="primary-font">'.$er['name'].' '.$er['surname'].'</strong> <small class="pull-right text-muted">
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
