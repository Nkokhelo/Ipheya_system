<?php
   require_once('../core/init.php');
   #retrieves sms dependencies
   // Require the bundled autoload file - the path may need to change
   // based on where you downloaded and unzipped the SDK
   require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
   #end sms
   use Twilio\Rest\Client;
   //sends sms
   $sid = 'AC2b62d7a561e2594e697b3c743dcf9357';//'ACdfe47878ff8fac9687667328ad171012';
   $token = '01eafc81bbb612e612385742f63ac78d';//'c5ad2f19607f819f3362683af66f8732';
   $client = new Client($sid, $token);
   $code = substr(md5(microtime()),0,5);

   session_start();
   if(isset($_SESSION['Client']))
   {
     $email = $_SESSION['Client'];
     $sql = mysqli_query($db, "SELECT * FROM authentication WHERE client_email = '$email' AND authenticate=1");
     $count = mysqli_num_rows($sql);
     if($count<1)
     {
       header('Location: home.php');
     }
     else{
       $user =  mysqli_query($db, "SELECT contact_number FROM clients WHERE email = '$email'");
       $result = mysqli_fetch_assoc($user);
       $number = $result['contact_number'];
       $num = '+27'.substr($number,1);

       // Use the REST API Client to make requests to the Twilio REST API
        $client->messages->create(
               // the number you'd like to send the message to
               $num,
               array(
                   // A Twilio phone number you purchased at twilio.com/console
                   'from' => '+14804705211',//'+12606455511 ',
                   // the body of the text message you'd like to send
                   'body' => $code
               )
           );
         $_SESSION['number'] = $num;
         $_SESSION['code'] = $code;
         //end sms
       //header('Location: verify-number.php?success=1');
     }
   }
   else{
     header('Location: ../login.php');
   }
   if(isset($_POST['Confirm']))
   {
     $otp = mysqli_real_escape_string($db, $_POST['otp']);
     $code = mysqli_real_escape_string($db, $_POST['code']);
     if($code== $otp)
     {
       header('Location: home.php');
     }
     else{
       #echo '<script>alert("Incorrect one time pin")</script>';
     }
   }
   if(isset($_POST['Resend']))
   {
     $user =  mysqli_query($db, "SELECT contact_number FROM clients WHERE email = '$email'");
     $result = mysqli_fetch_assoc($user);
     $number = $result['contact_number'];
     $num = '+27'.substr($number,1);

     // Use the REST API Client to make requests to the Twilio REST API
      $client->messages->create(
             // the number you'd like to send the message to
             $num,
             array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => '+12606455511 ',
                 // the body of the text message you'd like to send
                 'body' => $code
             )
         );
       $_SESSION['number'] = $num;
       $_SESSION['code'] = $code;
       echo '<script>alert("One time pin has been sent succesfully");</script>';
     //header('Location: verify-number.php?success=1');
   }
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>login</title>

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" type="text/css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" type="text/css"/>
  <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="">

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
  <script src="../assets/lib/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assets/lib/angular.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="module form-module" style="margin-top:5%;">
      <div class="toggle"><i class="fa fa-times fa-sign-in"></i>
        <div class="tooltip">2 Factor Authentication</div>
      </div>
      <div class="form" id="loginFrom">
        <h2>2 Factor Authentication</h2>
        <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
        <form action="" method="post">
          <input type="text" name="otp" placeholder="one time pin"/>
          <input type="hidden" name="code" value="<?=$_SESSION['code'];?>">
          <button type="submit" name="Confirm" style="margin-bottom:2%;">Confirm access</button>
      </div>
      <button type="submit" name="Resend">Resend (OTP)</button>
      </form>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script type="text/javascript">
   console.log('user: <?=$_SESSION['Client'];?> code: <?=$_SESSION['code'];?> number: <?=$_SESSION['number'];?>');
  </script>
</body>
</html>
