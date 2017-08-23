<?php

	session_start();
    if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/meeting-controller.php');
		// include('includes/navigation.php');
		// include('includes/employee-session.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>

<body>
<link href="../assets/fullcalendar/css/bootstrap.min.css" rel="stylesheet">
<link href='../assets/fullcalendar/css/fullcalendar.css' rel='stylesheet' />
    <div class="wrapper">
        <?php include 'includes/sidebar.php'?>
        <div id='content'>
            <div class='row'>
                <div class="col-xs-11 b">
                    <div class="col-xs-6">
                        <h3 class="text-center" style="color:#888">Meetings</h3><hr class="bhr"/>
                        <div id='calendar' >
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <h3 class="text-center" style="color:#888">All Tasks</h3><hr class="bhr"/>
                            <div class="col-xs-3">
                            <h4 class="text-center" style="color:#888">Progress</h4><hr class="bhr"/>
                            <h1 class="text-center" style="color:#86c0d6">
                                5
                            </h1><hr class="bhr"/>
                            </div>
                            <div class="col-xs-3">
                                <h4 class="text-center" style="color:#888">Complete</h4><hr class="bhr"/>
                                <h1 class="text-center" style="color:#86d6a4">
                                9
                                </h1><hr class="bhr"/>
                            </div>
                            <div class="col-xs-3">
                                <h4 class="text-center" style="color:#888">Over due</h4><hr class="bhr"/>
                                <h1 class="text-center" style="color:#fc8c7e">
                                8
                                </h1><hr class="bhr"/>
                            </div>       
                            <div class="col-xs-3">
                                <h4 class="text-center" style="color:#888">Total Task</h4><hr class="bhr"/>
                                <h1 class="text-center" style="color:#000">
                                22
                                </h1><hr class="bhr"/>
                            </div>       
                    </div>
                </div>  
            </div>
        </div>
    </div>
  <?php include('includes/footer.php'); ?>
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
        eventDrop: function(event, delta, revertFunc) { // If change of position

            edit(event);

        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // If change of length

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
    }});

</script>


