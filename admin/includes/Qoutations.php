<?php
    <?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
	 include('../core/logic.php');
     require_once("../core/controllers/qoutation-controller.php");
	 if(isset($_GET['Type']))
	 {
		$serviceT =$_GET['Type'];
	 }

?>
?>