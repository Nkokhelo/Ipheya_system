<?php
  include 'includes/head.php';
	include('../core/init.php');
	include('../core/logic.php');
	include('../core/controllers/meeting-controller.php');
	include('import/addEvent.php');
?>
<style>
			#calendar {
				max-width: 800px;
			}
			.col-centered{
				float: none;
				margin: 0 auto;
			}
</style>

<body>
  <link href="../assets/fullcalendar/css/bootstrap.min.css" rel="stylesheet">
	<link href='../assets/fullcalendar/css/fullcalendar.css' rel='stylesheet' />
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
				<div class="container">
					<div class="row">
						<div class="col-lg-10 b text-center">
								<h3>Request for Meeting</h3><hr class="bhr"/>
												<div id="calendar" class="col-xs-12">
												</div>
										</div>
							
								</div>
								<!-- /.row -->
						
						<!-- Modal -->
						<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
							<form class="form-horizontal" method="POST" action="">
							
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Add Event</h4>
								</div>
								<div class="modal-body">
								
									<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
									</div>
									<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
											<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
											<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
											<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
											<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
											<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
											<option style="color:#000;" value="#000">&#9724; Black</option>
											
										</select>
									</div>
									</div>
									<div class="form-group">
									<label for="start" class="col-sm-2 control-label">Start date</label>
									<div class="col-sm-10">
										<input type="text" name="start" class="form-control" id="start" readonly>
									</div>
									</div>
									<div class="form-group">
									<label for="end" class="col-sm-2 control-label">End date</label>
									<div class="col-sm-10">
										<input type="text" name="end" class="form-control" id="end" readonly>
									</div>
									</div>
								
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" name="save" class="btn btn-primary">Save changes</button>
								</div>
							</form>
							</div>
							</div>
						</div>
						
						
						
						<!-- Modal -->
						<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
							<form class="form-horizontal" method="POST" action="editEventTitle.php">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
								</div>
								<div class="modal-body">
								
									<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
									</div>
									<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
											<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
											<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
											<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
											<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
											<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
											<option style="color:#000;" value="#000">&#9724; Black</option>
											
										</select>
									</div>
									</div>
										<div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
											<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
											</div>
										</div>
									</div>
									
									<input type="hidden" name="id" class="form-control" id="id">
								
								
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
							</div>
							</div>
						</div>
						</div>
					  </div>
            </div>
        </div>
      </div>
			<?php include('includes/footer.php'); ?>
  </div>
</body>
	<script src="../assets/fullcalendar/js/jquery-1.10.2.js"></script>
	<script src="../assets/fullcalendar/js/bootstrap.min.js"></script>
	<script src='../assets/fullcalendar/js/moment.min.js'></script>
	<script src='../assets/fullcalendar/js/fullcalendar.js'></script>

<script>

$(document).ready(function() {
var today = moment(Date()).format("YYYY-MM-DD");
$('#calendar').fullCalendar({
	header:{
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listWeek'
	},
	defaultDate: today,
	defaultView: 'month',
	listDayFormat: 'dddd',
	listDayAltFormat: 'LL',
	locale: 'en',
	editable: true,
	selectable: true,
	allDaySlot: false,
	selectHelper: true,
	select: function(start, end) {
		
		$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
		$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
		$('#ModalAdd').modal('show');
	},
	eventRender: function(event, element) {
		element.bind('dblclick', function() {
			$('#ModalEdit #id').val(event.id);
			$('#ModalEdit #title').val(event.title);
			$('#ModalEdit #color').val(event.color);
			$('#ModalEdit').modal('show');
		});
	},
	eventDrop: function(event, delta, revertFunc) { // si changement de position

		edit(event);

	},
	eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

		edit(event);

	},
	events: [
	<?php while($event = mysqli_fetch_assoc($req)): 
	
		$start = explode(" ", $event['start']);
		$end = explode(" ", $event['end']);
		if($start[1] == '00:00:00'){
			$start = $start[0];
		}else{
			$start = $event['start'];
		}
		if($end[1] == '00:00:00'){
			$end = $end[0];
		}else{
			$end = $event['end'];
		}
	?>
		{
			id: '<?php echo $event['id']; ?>',
			title: '<?php echo $event['title']; ?>',
			start: '<?php echo $start; ?>',
			end: '<?php echo $end; ?>',
			color: '<?php echo $event['color']; ?>',
		},
	<?php endwhile; ?>
	]
});

function edit(event){
	start = event.start.format('YYYY-MM-DD HH:mm:ss');
	if(event.end){
		end = event.end.format('YYYY-MM-DD HH:mm:ss');
	}else{
		end = start;
	}
	
	id =  event.id;
	
	Event = [];
	Event[0] = id;
	Event[1] = start;
	Event[2] = end;
	
	$.ajax({
		url: 'http://localhost:81/Ipheya/client/import/editEventDate.php',
		type: "POST",
		data: {Event:Event},
		success: function(rep) {
			if(rep == 'OK'){
				alert('Saved');
			}else{
				alert(rep); 
			}
		}
	});
}

});

</script>

