<?php
# 21408789 Zulu NP
$con=mysqli_connect("localhost","root","");
	if(!$con)
		die("Could not connect".mysqli_error());
	mysqli_select_db($con,"Observe");


    if(isset ($_GET['id'])&&($_GET['id']))
    {
        $id=$_GET['id'];
        $result = mysqli_query($con,"DELETE FROM Surveying WHERE SurveyingID=$id")
        or die(mysqli_error($con));

        header("Location: View.php");

    }
    else
        header("Location: View.php");
?>
