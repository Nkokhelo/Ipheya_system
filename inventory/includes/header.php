<?php require_once 'cart_info.php'; ?>

<!DOCTYPE html>
<html>
<head>

	<title>Invetory Management</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../assets/site.css">

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-main" style="margin-bottom:1%;">
	  <div class="navbar-header">
	    <button type="button" class="navbar-toggle" style="color:#fff;" data-toggle="collapse" data-target="#main-menu">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a   href="index.php" class="navbar-brand text-uppercase">Ipheya</a>
	  </div>
	  <div class="container collapse navbar-collapse" id="main-menu">
	    <ul class="nav navbar-nav">
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Departments<span class="caret"></span></a>
	        <ul class="dropdown-menu" role="menu">
	          <li><a  href="../admin/departments.php">Departments</a></li>
	          <li><a  href="../admin/services.php">Services</a></li>
	        </ul>
	      </li>
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Employees<span class="caret"></span></a>
	        <ul class="dropdown-menu" role="menu">
	            <li><a  href="../admin/employees.php">Employees</a></li>
	            <li><a  href="../admin/roles.php">Roles</a></li>
	        </ul>
	      </li>
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Clients<span class="caret"></span></a>
	        <ul class="dropdown-menu" role="menu">
	          <li><a  href="../admin/clients.php">All clients</a></li>
	          <li><a  href="../admin/archives.php">Archived accounts</a></li>
	        </ul>
	      </li>
	      <li><a  href="../admin/clientRequest.php">Client Request</a></li>
	      <li><a href="../admin/CreateTask.php">Create Task</a></li>
	      <li><a href="inventory/items.php">Inventory</a></li>
	      <li><a href="../admin/targets.php">Targets</a></li>
	    </ul>
	  </div>
	</nav>
