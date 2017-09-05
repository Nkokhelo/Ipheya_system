<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
      require_once('../core/init.php');
      include('../core/logic.php');
      include('includes/head2.php');
      require_once('../core/controllers/client-controller.php');
      include('../core/controllers/chat-controller.php');
    }
    else
    {
      header("Location:../login.php");
    }
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
         <div class='col-xs-11 b'>
         <h3 class="text-center">Welcome </h3>
         <hr class="bhr"/>
         <div class="col-xs-12">

         </div>
        </div>
        </div>
        <?php include('includes/footer.php'); ?>
        <?php include('includes/chat.php'); ?>
      </div>
  </div>
</body>
<script src="../assets/fullcalendar/js/jquery-1.10.2.js"></script>
<script src="../assets/fullcalendar/js/bootstrap.min.js"></script>
<script src='../assets/fullcalendar/js/moment.min.js'></script>
<script src='../assets/fullcalendar/js/fullcalendar.js'></script>

<script>
	$(".table").dataTable();
</script>
