<?php

	session_start();
    if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
		include('includes/head.php');
		include('includes/navigation.php');
		include('includes/employee-session.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
