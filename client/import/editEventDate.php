<?php

// Connexion à la base de données
include('../../core/logic.php');
$log=new Logic();
$message='';
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2]))
{

	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";
	$query = mysqli_query($log->connect(), $sql);
	if(!$query)
	{
		$message='Error'.mysqli_error($log->connect());
	}
	else
	{
		$message="meeting has been updated!";
	}
	echo json_encode($message);
}	
?>