<?php
   require_once('core/init.php');
   include('core/logic.php');
   include('core/controllers/login-controller.php');
   include('core/controllers/register-controller.php');

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>login</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <script src="assets/lib/jquery-2.1.3.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.js"></script>  
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container-fluid">
    <div class="module form-module" style="margin-top:5%;">
      <div class="toggle"><i class="fa fa-times fa-pencil"></i>
        <div class="tooltip">register</div>
      </div>
      <div class="form">
      <script src='https://www.google.com/recaptcha/api.js'></script>
        <h2>Login to your account</h2>
        <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
        <form method="post">
          <input type="email" name="log-email" placeholder="Email"/>
          <input type="password" name="log-password" placeholder="Password"/>
          <div class="g-recaptcha" data-sitekey="6LcKVzMUAAAAAHZW5azejqnbBQWibIUX_jLxHp0B"></div>
          <button type="submit" name="Login">Login</button>
         <label for="acc" class="col-1">Accept Terms:</label><input type="checkbox" id="chk" name="chk"/>
         <label for="cr">Don't have account:</label><a href="">Create Account</a>
        </form>
      </div>
      <div class="form">
        <h2>Create an account</h2>
        <div class="" id="errors"><?=((isset($displayR))?$displayR:'');?></div>
        <form method="post" action="login.php">
          <input type="text" name="name" placeholder="Name"/>
          <input type="text" name="surname" placeholder="Surname"/>
          <input type="email" name="email" placeholder="Email Address"/>
          <input type="text" name="postal" value="" placeholder="Postal address">
          <input type="tel" name="number" placeholder="Phone Number"/>
          <input type="password" name="password" placeholder="Password"/>
          <button type="submit" name="Register">Register</button>
        </form>
      </div>
      <div class="cta" ><a href="">Forgot your password?</a></div>
    </div>
  </div>
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