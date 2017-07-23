<?php 

	session_start();
    if(isset($_SESSION['Employee']))
    {
		require_once('../core/init.php');
		include('../core/logic.php');
		include('includes/head.php');
		require('../core/controllers/taskController.php');
		include('includes/employee-session.php');
		include('includes/navigation.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
 
 
<div class="col-md-12">
<!--Task form-->
	<div class="col-sm-8 col-sm-offset-2 b">
		<h2>New Task</h2>
		<hr class="bhr"/>
			
		<form action="CreateTask.php" method="post">
			<div class="col-sm-6">
				<h4>Fill in task information</h4>
				<?=$feedback;?>
				<hr/>
				<table border="0">
					<tr>
						<td>Task Title</td>
						<td><input type="text"  class="form-control" name="task" required></td>
					</tr>
					<tr>
						<td>Task description </td>
						<td><textarea class="form-control" name="descr"  required></textarea></td>
					</tr>
					<tr>
						<td>Duration</td>
						<td style="padding:0;margin:0;">
							<div class="form-group" style="padding:0;margin:0;">
								<div class="input-group" style="padding:0;margin:0;">
									<input type="number"  id="dur" onblur="set_values()" class="input form-control" style="width:50%" name="dura" required>
									<select name="duraType" id="durType" onchange="set_values()" style="width:50%" class="input form-control">
										<option value="day">Day</option>
										<option value="week">Week</option>
										<option value="month">Month</option>
									</select>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>Start Date</td>
						<td><input  id="sdate" onblur="setMin()" class="form-control" name="Sdate"  required></td>
					</tr>
					<tr>
						<td>Task Location</td>
						<td><input type="text" id="location" onkeyup='search_place()' class="form-control" name="location" placeholder="Pick a location!" required></td>
					</tr>
				</table>
			<hr/>
			</div>
			<div class="col-sm-6">
				<!--Client Information-->
				<div class="col-sm-12" id="client">
					<h4>Client Contact information</h4>
					<hr/>
						Name : <?=$client['name']?><br>
						Email :<?=$client['email']?> <br>
						Phone Number : <?=$client['contact_number']?><br>
						Postal Address : <?=$client['postal_address']?><br>
						Residetial Address : <?=$client['postal_address']?><br><hr>
						<?=$type?> request for  <?=$name?> 
					<hr>
						
					<input name="ci" type="hidden" value="<?=$cid?>"/>
					<input name="ri" type="hidden" value="<?=$rid?>"/>
					<br>
					<br>
				</div>
				<!--Weather has to be fixed-->
				<div id="weather" class="col-sm-12 gllpMap  " style=" height:300px; ">
					<iframe id="forecast_embed" type="text/html" frameborder="0" height="245"width="100%"
						src="http://forecast.io/embed/#lat=-29.850148&lon=31.007463&name=South-Africa:Durban">
					</iframe>
				</div>
				<!--Map-->
				<div class="col-sm-12 col-md-12  " id='con'>
					<div id="googleMap" style="width:100%; height:300px; margin:1%; margin-bottom:50px;">
						<fieldset class="gllpLatlonPicker" style="margin-bottom:12px" id="custom_id">
							<div class="gllpMap" id="map" style="width:100%; height:300px; margin-bottom:10px; margin-right:50px; border:1px #808080 solid;">Google Maps</div>
							<input type="hidden" id="lat" class="gllpLatitude" value="-29.850148"/>
							<input type="hidden" id="lon" class="gllpLongitude" value="31.007463"/>
							<input type="hidden" class="gllpZoom" value="15"/>
							<div class="col-sm-12" style="border:1px #808080 solid; padding:1px;">
								<input type="text" width="20"  class="gllpSearchField">
								<input type="button" class="gllpSearchButton" onclick="search_place()" value="search">
							</div>
						</fieldset>
					</div>
				</div>
			</div>
			<hr class="bhr" style="width:100%"/>
			<div class="col-sm-8 col-sm-offset-2" style='margin-bottom:15px;'>
					<input type="submit" class="btn btn-default" name="submit" value="Create Task">
			</div>
		</form>
	</div>
	<script>
			function search_place()
			{
			
				var loca = $('#location').val();
				if(loca!=null)
				{
					$('#location').val(" ");
					$('#location').attr("placeholder","Doubleclick map to corfirm task location");
				}
			}
			$('#googleMap').hide();
			$('#weather').hide();
			$('#con').hide();
			function myMap() 
			{
				google.maps.event.trigger(map, "resize");
			}
			$(".selector").button({ label: "custom label" });	
			$("#location").on('click', function()
			{
				$('#weather').hide();
				$('#googleMap').fadeIn();
				$("#googleMap").fadeIn("slow");
				$("#googleMap").fadeIn(3000);
				$("#con").show();
				// $("#task").hide();
				$('#client').hide();	
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
				$('#client').hide();	
				
			});
			$("#map").dblclick(function()
			{
				var lat =parseFloat($('#lat').val());
				var lon =parseFloat($('#lon').val());
				$('#location').val(lat.toFixed(6)+", "+lon.toFixed(6));
			});
			
			$('#sdate').datepicker(
				{
					minDate:0,
					dateFormat: 'yy-mm-dd',
					beforeShowDay: function(date) 
					{
						var dayOfWeek = date.getDay();
						// 0 : Sunday, 1 : Monday, ...
						if (dayOfWeek == 0 || dayOfWeek == 6) return [false];
						else return [true];
					},
					selectOtherMonths: false,
					showWeek: true
				});

			
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>