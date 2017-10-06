<?php
// function generatePin($digits=4)
//     {
//       $i=0;
//       $pin="";
//       while($i<$digits)
//       {
//         $pin.=mt_rand(1000,9999);
//         $i++;
//       }
//       return $pin;
//     }
//     $pin=generatePin();
//     echo $pin,'<br>';

//     $pin=generatePin(0);
//     echo $pin;
 require_once('includes/verify.php');

//  if(isset($_POST['number']))
//  {
//      session_start();
//      $number=$_POST['number'];
//      $code=rand(1000,9999);
//      $_SESSION['code']=$code;







    //  header('Location: includes/verify.php');
    //  return;




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://nexmo.com/favicon.ico">

    <title>Phone Verification Example</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">

    <!--<form class="form-verify" role="form" method="POST" action="index.php">
        <h2 class="form-verify-heading">Verify Your Phone</h2>
        <input name="number" type="tel" class="form-control" placeholder="Phone number" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
    </form>-->

</div> <!-- /container -->
</body>
</html>
