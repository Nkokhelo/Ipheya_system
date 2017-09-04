<?php
session_start();
if(isset($_SESSION['Client']))
{
  include 'includes/head.php';
  include('../core/init.php');
  include('../core/controllers/chat-controller.php');
}
else
{
  header('../login.php');
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <h1>Contact</h1>
              <?php include('includes/chat.php'); ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>\
</body>
