<?php
     require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/role-controller.php');
     include('includes/employee-session.php');
    // session_start();
    if(isset($_SESSION['Employee']))
    {

    }
    else
    {
      header('Location: login.php');
    }
?>
<div class="row" style="margin-left:0; margin-right:0;">
	<div class="col-lg-12">
		<h1>Dashboard</h1>
		<hr/>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				6 Departments
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				 5 Services
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				 10 Employees
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				5 Clients
			</div>

      		
			<div class="col-lg-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<b>[ClientName] requested for [RequestType]</b>
						<div class="dropdown pull-right">
								<a class="btn dropdown-toggle" data-toggle="dropdown">
									<span  class="glyphicon glyphicon-menu-hamburger"></span>
								</a>
								 <ul class="btn dropdown-menu ">
									  <li><a href="#">Set up surveying date</a></li>
									  <li><a href="#">Make Qoutation</a></li>
									  <li><a href="#">Set warrant</a></li>
									  <li><a href="#">Review Tickets</a></li>
									</ul>
						</div>
						
					</div>
					<div class="pane-body">
						[The service description]
						 The blas and blas and blas
					</div>
					<div class="panel-footer">
						Request Date /2 hrs ago
					</div>
				</div>
			</div>
	</div>
</div>

