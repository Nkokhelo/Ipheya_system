<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
     include('includes/employee-session.php');
?>

 
<div class="col-md-12">
	<div class="col-md-6">
		<h1>Create Task</h1>
		<form action="Task.php" method="post">
		<table border="0">
			<tr>
			<td>Task Name</td>
			<td><input type="text"  class="form-control" name="task" <?php if(isset ($_POST['task'])) echo"value='$task'" ?> required>
			<?php if($task_error) echo "Enter task" ?></td>
			</tr>
			
			<tr>
			<td>Description </td>
			<td><textarea class="form-control" name="descr" <?php if(isset($_POST['descr'])) echo"value='$descr'" ?> required></textarea>
			<?php if($descr_error) echo "Enter Description"?></td>
			</tr>
			
			<tr>
			<td>Duration</td>
			<td><input type="text" class="form-control" name="dura" <?php if(isset ($_POST['dura'])) echo"value='$dura'" ?> required>
			<?php if($dura_error) echo "Enter Duration" ?></td>
			
			
			<td>Select Duration Type</td>
			<td><select name="duraType" class="form-control">
			<option value="day">Day</option>
			<option value="week">Week</option>
			<option value="month">Month</option>
			</select></td>
			</td >
			<tr>
			<td>Start Date</td>
			<td><input type="date" id="sdate" onClick="onThisClick(this)" class="form-control" name="Sdate" <?php if(isset ($_POST['Sdate'])) echo"value='$Sdate'" ?> required>
			<?php if($Sdate_error) echo "Enter Start Date" ?></td>
			</tr>
			
			<tr>
			<td>End Date</td>
			<td><input type="date" class="form-control" name="Edate" <?php if(isset ($_POST['Edate'])) echo"value='$Edate'" ?> required>
			<?php if($Edate_error) echo "Enter End Date "?></td>
			</tr>
			<td>Task Location</td>
			<td><input type="text" id="location" class="form-control" name="Edate" <?php if(isset ($_POST['Edate'])) echo"value='$Edate'" ?> required>
			<?php if($Edate_error) echo "Enter End Date "?></td>
			</tr>
			
			<tr>
			<td><input type="submit" class="form-control" name="submit" value="Create Task"></td>
			</tr>
		</table>
		</form>

		<table border="0">
			<h1>Assign Task</h1>
			<table>
				<tr>
					<td>Select Department</td><td>Select Employee</td><td>Select Task</td>
				</tr>
				<tr>
					<td>
						<select multiple class="form-control">
							<option>Digital Signage</option>
							<option>Server</option>
						</select>
					</td>
					<td>
						<select multiple class="form-control">
							<option>Nomvelo Zulu</option>
							<option>Siwe Kubheka</option>
							<option>Educare Zenzile</option>
						</select>
					</td>

					<td>
						<select multiple class="form-control">
							<option>Server Installation</option>
							<option>Computer Repair</option>
							<option>Installing cameras</option>
						</select>
					</td>
				</tr>
		</table>
	</div>
	<div class="col-md-6">
			<div class="col-md-12">
				<h3>list of task</h3> 
					<?=$feedback?>
			</div>
	</div>
	<!-- weather widget start -->
	<div id="weather" class="col-md-6 gllpMap" style="width:40%; height:300px; display:none;">
		<iframe id="forecast_embed" type="text/html" frameborder="0" height="245"width="100%"
			src="http://forecast.io/embed/#lat=-29.850148&lon=31.007463&name=South-Africa:Durban">
		</iframe>
	</div>
	<div id="googleMap" class="col-md-6" style="width:40%;display:none; height:300px;">
		<fieldset class="gllpLatlonPicker" id="custom_id">
			<input type="text" class="gllpSearchField">
			<input type="button" class="gllpSearchButton" value="search">
			<div class="gllpMap" id="map" style="width:100%; height:300px;">Google Maps</div>
			<input type="hidden" id="lat" class="gllpLatitude" value="-29.850148"/>
			<input type="hidden" id="lon" class="gllpLongitude" value="31.007463"/>
			<input type="hidden" class="gllpZoom"value="15"/>
		</fieldset>
	</div>
	<script>
		function myMap() 
		{
			// var mapProp= 
			// {
			// 	center:new google.maps.LatLng(-29.850148, 31.007463),
			// 	zoom:15,
			// };
			var map=new google.maps.Map($('#map'));
		}
		$("#location").on('click', function()
		{
    		$('#googleMap').css('display','block');
    		$('#weather').css('display','none');
			myMap(); 
		});
		$("#sdate").on('click', function()
		{
    		$('#weather').css('display','block');
			$('#googleMap').css('display','none');
		});
			$('#googleMap').locationpicker();
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>
</div>
