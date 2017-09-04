<?php

	session_start();
    if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/meeting-controller.php');
        include('../core/controllers/admin-controller.php');
				$sql = "SELECT * FROM meetings";
				$req = mysqli_query($db,$sql);
    }
    else
    {
        header('Location:../login.php');
    }
?>
<style>
    div.fc-center h2
    {
        color:#888;
        font-size:13px;
        line-height:2px;
    }
		button.ui-state-active
		{
			color:#888;
		}
</style>
<body>
<link href='../assets/fullcalendar/css/fullcalendar.css' rel='stylesheet'/>
    <div class="wrapper">
        <?php include 'includes/sidebar.php'?>
        <div id="content">
            <div class='row'>
                <div class="col-xs-11 b">

								<?= "<br/>". $feedback; ?>
                    <div class="col-xs-6">
                        <h3 class="text-center" style="color:#888">Meetings</h3><hr class="bhr"/>
                        <div id='calendar' >
                            </div>
                    </div>
                    <div class="col-xs-6">
                        <h3 class="text-center" style="color:#888">2017 Total Tasks <?= $tott?></h3><hr class="bhr"/>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Created</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#000">
                            <?= $nt?>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Progress</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#86c0d6">
                            <?= $tp?>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Complete</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#86d6a4">
                            <?= $tc ?>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Over due</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#fc8c7e">
                            <?= $to?>
                            </h1><hr class="bhr"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <hr class="bhr"/>
                        <h3 class="text-center" style="color:#888">2017 Total Projects <?= $totp ?></h3><hr class="bhr"/>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Created</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#000">
                            <span class="count"><?= $np ?></span>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Progress</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#86c0d6">
                            <span class="count"><?= $pp ?></span>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Complete</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#86d6a4">
                            <span class="count"><?= $pc ?></span>
                            </h1><hr class="bhr"/>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Over due</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#fc8c7e">
                            <span class="count"><?= $po ?></span>
                            </h1><hr class="bhr"/>
                        </div>
                        <hr class="bhr"/>
                    </div>
                    <div class="col-xs-12">
                    <hr	/>
										<div class="modal fade" id="View" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
													<form class="form-horizontal" method="POST" action="">

														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h2 class="modal-title" id="myModalLabel" class="text-center" style="color:#888"><p id="header"></p></h2>
														</div>
														<div class="modal-body">
																<table class="table">
																	<tr style="border-top:none"><td><b>Meeting Title</b></td><td><p id="title"></p></td></tr>
																	<tr><td><b>Clinet name</b></td><td><p id="name"></p></td></tr>
																	<tr><td><b>Email</b></td><td><p id="email"></p></td></tr>
																	<tr><td><b>Description</b></td><td><p id="description"></p></td></tr>
																	<tr><td colspan="2"><b>From :</b><p id="from" style="display:inline"></p><b> To :</b><p style="display:inline" id="to"></p></td></tr>
																	<tr><td><b>Registered client?</b></td><td><p id="is"></p></td></tr>
																</table>
															</div>
															<div class="form-group">
														</div>
														<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</form>
													</div>
													</div>
												</div>
										<div class="modal fade" id="feed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog modal-md" role="document">
													<div class="modal-content">
													<form class="form-horizontal" method="POST" action="">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h3 class="modal-title" id="myModalLabel" class="text-center" style="color:#888">Alert</h3>
														</div>
														<div class="modal-body">
															<h5>Meeting has been schaduled successfully</h5>
																Send notification to <p id="name" style="display:inline">	</p> about the meeting scheduling
															</br/>
															<input type="hidden" id="event_id" />
															<input type="hidden" id="email" />
														</div>
														<div class="modal-footer">
															<button type="submit" name="yes_send" class="btn btn-primary" ><i class="fa fa-ok"></i>Yes</button>
															<button type="submit" name="not_now" class="btn btn-primary" ><i class="fa fa-history"></i>Not now</button>
														</div>
													</form>
													</div>
													</div>
												</div>
                    </div>
                </div>
            </div>
        </div>
				<?php if($notify!=null) {?>
					<div class="to_notify">
						<h4 class="text-center">Not notified clients</h4>
						<table class="table">
							<?=$notify?>
						</table>
					</div>
				<?php } ?>
    </div>
  <?php include('includes/footer.php'); ?>
</body>
<script src="../assets/fullcalendar/js/jquery-1.10.2.js"></script>
<script src="../assets/fullcalendar/js/bootstrap.min.js"></script>
<script src='../assets/fullcalendar/js/moment.min.js'></script>
<script src='../assets/fullcalendar/js/fullcalendar.js'></script>

<script>

    $(document).ready(function() {

    $('h4 h1.text-center .count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    var today = moment(Date()).format("YYYY-MM-DD");

    $('#calendar').fullCalendar({
        theme: true,
        header:{
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: today,
        weekNumbers: true,
        weekNumbersWithinDays: true,
        eventLimit: true, // allow "more" link when too many events
        defaultView: 'month',
        listDayFormat: 'dddd',
        listDayAltFormat: 'LL',
        businessHours: true, // display business hours
        locale: 'en',
        editable: true,
        selectable: true,
        allDaySlot: true,
        selectHelper: true,
        select: function(start, end) {
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element)
				{
            element.bind('dblclick', function()
						{
								$('#View #header').text(event.title);
								$('#View #email').text(event.email);
								$('#View #name').text(event.name);
								$('#View #title').text(event.title);
								if(event.is_client ==1)
								{
									$('#View #is').text("Yes");
								}
								else
								{
									$('#View #is').text("No");
								}
								$('#View #description').text(event.description);
								$('#View #from').text(moment(event.start).format("DD-MM-dddd HH:mm"));
								$('#View #to').text(moment(event.end).format("DD-MM-dddd HH:mm"));
                $('#View').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // If change of position
            edit(event);
        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // If change of length
            edit(event);
        },
				events: [
				<?php while($event = mysqli_fetch_assoc($req)):	?>
				{
					id: '<?php echo $event['meeting_id']; ?>',
					name : '<?php echo $event['name']; ?>',
					title: '<?php echo $event['m_title'] ?>',
					description: '<?php echo $event['m_description']; ?>',
					start: '<?php echo $event['m_start']; ?>',
					end: '<?php echo $event['m_end']; ?>',
					color: '<?php echo $event['color']; ?>',
					is_client: '<?php echo $event['is_client']?>',
					email : '<?php echo $event['email']?>',
					is_notified : '<?php echo $event['is_notified']?>'
				},
				<?php endwhile; ?>
				]
			});

    function edit(event)
    {
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end)
				{
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }
				else
				{
            end = start;
        }
        id =  event.id;
				alert(start);
        Event = [];
        Event[0] = id;
        Event[1] = start;
        Event[2] = end;

        $.ajax({
            url: 'http://localhost:81/Ipheya/client/import/editEventDate.php',
            type: "POST",
            data: {Event:Event},
            success: function(rep) {
							rep = JSON.parse(rep);
							if(rep !="error")
							{
									$('#feed #event_id').val(id);
									$('#feed #name').text(event.name);
									$('#feed #email').val(event.email);
									$("#feed").modal('show');
							}
							else
							{
								alert(rep+" success");
							}
            }
        });
    }

    });

</script>
