<?php
   require_once('../core/init.php');
   #retrieves sms dependencies
   // Require the bundled autoload file - the path may need to change
   // based on where you downloaded and unzipped the SDK
   require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
   #end sms
   use Twilio\Rest\Client;
   //sends sms
   $sid = 'ACdfe47878ff8fac9687667328ad171012';
   $token = 'c5ad2f19607f819f3362683af66f8732';
   $client = new Client($sid, $token);

   session_start();
   if(isset($_SESSION['Client']))
   {
     $email = $_SESSION['Client'];
     $sql = mysqli_query($db, "SELECT * FROM authenticate WHERE client_email = '$email' AND authenticate=1");
     $count = mysqli_num_rows($sql);
     if($count<1)
     {
       header('Location: home.php');
     }
     else{
       $user =  mysqli_query($db, "SELECT contact_number FROM Clients WHERE email = '$email'");
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
                   'body' => "1555"
               )
           );
         $_SESSION['number'] = $num;
         //end sms
       header('Location: verify-number.php?success=1');
     }
   }
   else{
     header('Location: ../login.php');
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
        <form action="register.php" method="post">
          <input type="tel" name="otp" placeholder="one time pin"/>
          <button type="submit" name="Confirm" style="margin-bottom:2%;">Confirm Cell number</button>
        </form>
      </div>
      <button type="submit" name="button" style="background-color:e51515;">Resend (OTP)</button>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script type="text/javascript">
  $(document).ready(function()
  {
      // Toggle function
      $('.toggle').click(function(){
        // Switches the Icon
        $(this).children('i').toggleClass('fa-sign-in');
        // Switches the forms
        $('.form').animate({
          height: "toggle",
          'padding-top': 'toggle',
          'padding-bottom': 'toggle',
          opacity: "toggle"
        }, "slow");
      });

//
        };
  </script>
</body>
</html>
