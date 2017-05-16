<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
     include('includes/employee-session.php');
?>

 
<div class="col-md-12">
	<div class="col-md-6 b">
		<h1>Create Task</h1>
		<hr class="bhr"/>
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
		</table>
		<hr class="bhr"/>
		<input type="submit" class="form-control" name="submit" value="Create Task">
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
	<div id="weather" class="col-md-6 gllpMap shift b" style="width:49%; height:300px; ">
		<iframe id="forecast_embed" type="text/html" frameborder="0" height="245"width="100%"
			src="http://forecast.io/embed/#lat=-29.850148&lon=31.007463&name=South-Africa:Durban">
		</iframe>
	</div>
	<div class="col-md-6 b shift">
		<div id="googleMap" style="width:100%; height:300px;">
			<fieldset class="gllpLatlonPicker" style="margin-bottom:12px" id="custom_id">
				<div class="gllpMap" id="map" style="width:100%; height:300px;">Google Maps</div>
				<input type="hidden" id="lat" class="gllpLatitude" value="-29.850148"/>
				<input type="hidden" id="lon" class="gllpLongitude" value="31.007463"/>
				<input type="hidden" class="gllpZoom"value="15"/>
				<input type="text" width="20" class="gllpSearchField">
				<input type="button" class="gllpSearchButton" value="search">
			</fieldset>
		</div>
	</div>

	<script>
		$('#googleMap').hide();
		$('#weather').hide();
		function myMap() 
		{
			google.maps.event.trigger(map, "resize");
		}
		$("#location").on('click', function()
		{
			$('#googleMap').show();
			$('#weather').hide();
			myMap();
			$('#location').val($('#lat').val()+", "+$('#lon').val())
		});
		$("#sdate").on('click', function()
		{
    		$('#googleMap').hide();
			$('#weather').show();
		});
		$("#map").dblclick(function()
		{
			var lat =parseFloat($('#lat').val());
			var lon =parseFloat($('#lon').val());
			if(((lat<-30.008616)&&(lat>-29.737134))||((lon>30.787823)&&(lon<31.079611)))
			{
				$('#location').val('Invalid place wa selected');
			}
			else
			{
				$('#location').val(lat.toFixed(6)+", "+lon.toFixed(6));
			}

		});

		// $('#map').locationpicker();
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>
</div>
