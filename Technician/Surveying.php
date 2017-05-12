<?php
	ini_set('mysqli.connect_timeout',300);
	ini_set('default_socket_timeout',300);
?>
<html>
<?php
  include('../core/init.php');
	include('includes/head.php');
	include('includes/navigation.php');
	$request=mysqli_query($db,'select * from servicerequest');

	$reqID="";$ReqID_err=0;
	$description="";$description_err=0;
	$image="";$image_err=0;

	if(isset($_POST["submit"]))
	{
		if($_POST["reqID"]==null)
			$reqID_err=1;
		else
			$reqID=$_POST["reqID"];

		if($_POST["discr"]==null)
			$description_err=1;
		else
			$description=$_POST["discr"];

		if($_POST["image"]==null)
			$image_err=1;
		else
			$image=$_POST["image"];
	}
?>
<div class="container-fluid" style="padding:1%;">
	<h2 class="text-center">Record Survey</h2><hr>
	<div class="col-md-6" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
		<form class="form" action="Surveying.php" method="POST">
			<legend class="text-center">Survey details</legend>
			<div class="form-group">
				<label for="reqID">Request id</label>
				<select class="form-control" name="reqID" id="reqID">
						<?php
							while($arrReq=mysqli_fetch_row($request))
							{
								echo "<option value='$arrReq[0]'>$arrReq[1]</option>";
							}
						?></select>
			</div>
			<div class="form-group">
				<label for="discr">Description</label>
				<textarea name="discr" id="discr" class="form-control" rows="5" cols="40" value='<?php echo $description?>' <?php if($description_err) echo "placeholder='Enter Discription'"?>/></textarea>
			</div>
			<div class="form-group">
				<label for="image">Photos</label>
				<input type="file" name="image" id="image" value='<?php echo $image?>' required/><?php if($image_err) echo "Images"?>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Add Record"/>
			</div>
		</form>
	</div>
</div>
<?php
	if(isset($_POST["submit"]))
	{

		mysqli_select_db($db,"Observe");
		$obs="Select RequestID from Surveying Where RequestID='$_POST[reqID]'";

		//if(!isset($_FILES["image"]["tmp_name"]))
		//{
			//echo "Please select Image";
		//}

		//else
		//{
			//$image=addslashes($_FILES['image']['tmp_name']);
			//$image=file_get_contents($image);
			//$image=base64_encode($image);

			$insert="Insert into Surveying (RequestID,Description,Image) Values
			('$_POST[reqID]','$_POST[discr]','$image')";
			if(mysqli_query($db,$insert))
			{
			echo "Recorded successful";
			header("Location:View.php");
			}
			else
				echo "Failed to record".mysqli_error($db);

			}

			//$res="Select * from Surveying ";
			//$result=mysqli_query($db,$res);
			//while ($row=mysqli_fetch_array($result))
			//{
				//echo '<img height="300" width="300" src="data:Image;base64,'.$row[3].'"';
			//}
		//}
		mysqli_close($db);

	// displayImage();
	// function displayImage()
	// {
	// 	// mysqli_select_db($db,"Observe");
?>

</html>
