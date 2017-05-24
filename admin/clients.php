<?php
		 require_once('../core/init.php');
		 include('includes/head.php');
		 include('includes/navigation.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/client-controller.php');
		 include('includes/employee-session.php');
?>
<div class="container-fluid" style="padding:1%;">
		<div class="col-sm-8 col-sm-offset-2 b">
			<h2 class="text-center">List of Clients</h2></h2><hr class="bhr">
			<table class="table  " style="padding:2%;">
				<thead>
					<th>Name</th><th>Email</th><th>Contact</th><th>Options</th>
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
