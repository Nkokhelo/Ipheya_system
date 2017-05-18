<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
     include('includes/employee-session.php');
?>
 
 
<div class="col-md-12">
	<div class="col-md-6 b" >
		<h2>Add new task</h2>
		<hr class="bhr"/>
		<form action="CreateTask.php" method="post">
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
				<td style="padding:0;margin:0;">
					<div class="form-group" style="padding:0;margin:0;">
						<div class="input-group" style="padding:0;margin:0;">
							<input type="text" class="input form-control" style="width:50%" name="dura" <?php if(isset ($_POST['dura'])) echo"value='$dura'" ?> required>
							<select name="duraType" style="width:50%" class="input form-control">
								<option value="day">Day</option>
								<option value="week">Week</option>
								<option value="month">Month</option>
							</select>
						</div>
					</div>
				</td>
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
				<td><input type="text" id="location" class="form-control" name="location" <?php if(isset ($_POST['location'])) echo"value='$loca'" ?> required></td>
				</tr>
			</table>
			<hr class="bhr"/>
			<div class="col-sm-8 col-sm-offset-2" style='margin-bottom:15px;'>
					<input type="submit" class="btn btn-default" name="submit" value="Create Task">
			</div>
		</form>
	</div>
	<div class="col-md-6 b shift" id='task' style="margin-bottom:10px padding-bottom:10px; height:410px; overflow-x:hidden;">
			<h2>All unassigned tasks</h2> <hr class="bhr"/>
			<div class="col-md-12" style='overflow-y:scroll;width:105%; height:290px'>
				<div class="col-md-12">
				 <?=$feedback?>
				 <?=$tasksAll?>
				</div>
			</div>
	</div>
	<!-- weather widget start -->
	<div id="weather" class="col-md-6 gllpMap shift b" style="width:49%; height:300px; ">
		<iframe id="forecast_embed" type="text/html" frameborder="0" height="245"width="100%"
			src="http://forecast.io/embed/#lat=-29.850148&lon=31.007463&name=South-Africa:Durban">
		</iframe>
	</div>
	<div class="col-sm-12 col-md-6 b shift" id='con'>
		<div id="googleMap" style="width:100%; height:300px; margin:1%; margin-bottom:50px;">
			<fieldset class="gllpLatlonPicker" style="margin-bottom:12px" id="custom_id">
				<div class="gllpMap" id="map" style="width:100%; height:300px; margin-bottom:10px; margin-right:50px; border:1px #808080 solid;">Google Maps</div>
				<input type="hidden" id="lat" class="gllpLatitude" value="-29.850148"/>
				<input type="hidden" id="lon" class="gllpLongitude" value="31.007463"/>
				<input type="hidden" class="gllpZoom"value="15"/>
				<div class="col-sm-12" style="border:1px #808080 solid; padding:1px;">
					<input type="text" width="20" class="gllpSearchField">
					<input type="button" class="gllpSearchButton"  value="search">
				</div>
			</fieldset>
		</div>
	</div>
</div>

	<script>
		$('#googleMap').hide();
		$('#weather').hide();
		$('#con').hide();
		$('#allTask').hide();
		function myMap() 
		{
			google.maps.event.trigger(map, "resize");
		}
		$("#location").on('click', function()
		{
			$('#weather').hide();
			$('#googleMap').fadeIn();
			$("#googleMap").fadeIn("slow");
			$("#googleMap").fadeIn(3000);
			$("#con").show();
			$("#task").hide();
			myMap();
			$('#location').val($('#lat').val()+", "+$('#lon').val())
		});
		$("#sdate").on('click', function()
		{
    		$('#googleMap').hide();
    		$('#con').hide();
			$('#weather').fadeIn();
			$("#weather").fadeIn("slow");
			$("#weather").fadeIn(3000);
			$("#task").hide();
		});
		$("#map").dblclick(function()
		{
			var lat =parseFloat($('#lat').val());
			var lon =parseFloat($('#lon').val());
			$('#location').val(lat.toFixed(6)+", "+lon.toFixed(6));
		});
		

		// $('#map').locationpicker();
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>