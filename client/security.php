<?php
session_start();
if(isset($_SESSION['Client']))
{
  include('../core/init.php');
  include('includes/head.php');
   include('../core/controllers/authentication-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>

            <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Home</a></li>
              </ol>
            </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2>Account security</h2><hr class="bhr">
                <p>Two factor authentication or <b>2FA</b> is an extra layer authentication that requires a
                   code which will be sent to the mobile number you used when creating an account.
                 <br>
                <i><?=$msg;?></i>
                 </p>
                   <div class="col-sm-6">
                       <?=((isset($disabled))?'<a href="security.php?enable=1" class="btn btn-info">Click to enable 2FA</a>':'<a href="security.php?enable=1" class="btn btn-warning">Click to disable 2FA</a>');?>
                   </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
