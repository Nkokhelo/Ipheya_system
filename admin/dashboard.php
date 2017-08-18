<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
      require_once('../core/init.php');
      include('includes/head2.php');
      include('../core/logic.php');
      require_once('../core/controllers/client-controller.php');
		//  include('includes/navigation.php');
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
           <h3 class="text-center">Welcome <?php echo($_SESSION['Employee'])?> </h3> 
             <hr class="bhr"/>
             <div class="col-xs-12">

             </div>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
</body>
<script>
	$(".table").dataTable();
</script>