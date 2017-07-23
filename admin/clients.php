<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
		 require_once('../core/init.php');
		 include('includes/head.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/client-controller.php');
		 include('includes/navigation.php');
    }
    else
    {
      header("Location:../login.php");
    }
     

?>
<div class="container-fluid" style="padding:1%;">
		<div class="col-sm-8 col-sm-offset-2 b">
			<h2 class="text-center">All Clients</h2></h2><hr class="bhr">
			<table class="table  " style="padding:2%;">
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
<?php include('includes/footer.php'); ?>
<script>
	$(".table").dataTable();
</script>