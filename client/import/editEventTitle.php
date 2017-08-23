<?php
include('../../core/logic.php');
$log=new Logic();
$message='';
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
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
else if (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	
	$sql = "UPDATE events SET  title = '$title', color = '$color' WHERE id = $id ";

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
