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
            <div class='col-xs-10 b'>
              <h2 class="text-center">All Clients</h2></h2><hr class="bhr">
							<table class=" table table-bordered" >
								<thead>
									<th>Client No</th><th>Name</th><th>Email</th><th>Options</th>
								</thead>
								<tbody>
									<?=$allClients;?>
								</tbody>
								<tfoot>

								</tfoot>
							</table>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
	$(".table").dataTable();
</script>