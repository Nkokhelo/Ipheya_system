<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');
		include('includes/head2.php');
		include('../core/controllers/observation-controller.php');
	}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-11 b">
                <h2>Send surveyor </h2><hr class="bhr"/>

                <!--Obsevations Form start-->
                <form action="" method="post">
																	<div class="col-sm-6">
																		<h4 style="color:#888"><i class="fa fa-wpforms"></i> - Fill in task information</h4>
																		<?=$feedback;?>
																		<hr/>
																		<div class="col-xs-10">
																			<label for="task">Title</label>
																			<input type="text"  class="form-control" name="task" required>
																		</div>
																		<div class="col-xs-12">
																			<label for="descr">Description</label>
																			<textarea class="form-control" name="descr"  required></textarea>
																		</div>
																		<div class="col-xs-12">
																			<label for="dura">Duration</label>
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
																		</div>
																		<div class="col-xs-6">
																			<label for="Sdate">Start</label>
																			<input  id="sdate" onblur="setMin()" class="form-control" name="Sdate"  required>
																		</div>
																		<div class="col-xs-6">
																			<label for="location">Location</label>
																			<input type="text" id="location" onkeyup='search_place()' class="form-control" name="location" placeholder="Pick a location!" required>
																		</div>
																	</div>
																	<div class="col-sm-6">
																		<!--Client Information-->
																		<div class="col-sm-12" id="client">
																			<h4 style="color:#888"><span class="fa fa-user"></span> - Client Infomation</h4>
																			<hr/>
																			<table>
																				<tr>
																					<td><label>Name </label> </td>
																					<td>: <?=$client['name']?></td>
																				</tr>
																				<tr>
																					<td><label>Email </label></td>
																					<td>: <?=$client['email']?></td>
																				</tr>
																				<tr>
																					<td><label>Phone Number </label></td>
																					<td>: <?=$client['contact_number']?></td>
																				</tr>
																				<tr>
																					<td><label for="">Postal Address </label> </td>
																					<td>: <?=$client['postal_address']?></td>
																				</tr>

																			</table>
																				 <br><hr>
																				<h4 style="color:#888"><span class="fa fa-send"></span> - Request Infomation</h4>
																				<?=$type?> request for  <?=$name?>
																				<p style="border:#888 solid 1px; padding:2px; padding-left:-12px; margin:1px;"><?=$request['Description'];?></p>
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
																	<hr style="width:100%"/>
																	<div class="col-xs-12">
																		<h4 style="color:#888"><i class="fa fa-user-plus"></i> - Assign to a suveyor</h4>
																		<a class="btn btn-default">
																			<i class="fa fa-plus" onclick="showdropdown()"></i>
																		</a>
																		<select class="form-control" id="select" name='employee' style="width:60%; display:inline;" >
																			<?=$allemp?>
																		</select>
																	</div>
																	<hr class="bhr" style="width:100%; padding-top:10px;"/>
																	<div class="col-xs-6 col-xs-offset-3">
																			<input type="submit" class="btn btn-block btn-default" name="submit" value="Send Surveyor">
																	</div>
																</form>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
	<script>
			function search_place()
			{
//old js
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
//select 2
$('#select').select2();
$('#select').click(function(){
				$("#task").hide();
				$('#client').fadeInRight();
				$('#googleMap').fadeOutLeft();
})
$('#client')
	</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>
