<?php

include '../core/init.php';
include( '../core/logic.php');
include( '../core/controllers/login-controller.php');
include('../core/controllers/register-controller.php');


if(isset($_POST['code']))
{
    session_start();
    if($_SESSION['code']==$_POST['code'])
    {
        $text="Your phone number has been verified.";
    }
    else{
        $text="Sorry!!! your code is incorrect, verification cannot be done";
    }
}
      //API Url
$url = 'https://api.bulksms.com/v1/messages';

//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = array(
   'to' => '+27794596247',
   'body' => 'This is the sms test'
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Execute the request
$result = curl_exec($ch);
echo $result;
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>verify</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <script src="../assets/lib/jquery-2.1.3.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container-fluid">
  <div class="module form-module" style="margin-top:5%;">
    <div class="form">
      <div class="toggle"><i class="fa fa-times fa-pencil"></i>
        <div class="tooltip">register</div>
      </div>
      <form method="POST" action="confirm.php">
          <h2 class="form-verify-heading text-center">Confirm Your Code</h2>
          <input name="code" type="text" placeholder="Confirm code" value="WTF" required autofocus>
          <button type="submit">Confirm</button>
          <?php if(isset($text)): ?>
              <div class="alert alert-info" role="alert">
                  <p><?php echo $text ?></p>
              </div>
          <?php endif; ?>
        </form>
    </div>
  </div>
</div> <!-- /container -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
<script type="text/javascript">
// Toggle Function
$('.toggle').click(function(){
// Switches the Icon
$(this).children('i').toggleClass('fa-pencil');
// Switches the forms
$('.form').animate({
  height: "toggle",
  'padding-top': 'toggle',
  'padding-bottom': 'toggle',
  opacity: "toggle"
}, "slow");
});
</script>
</html>
