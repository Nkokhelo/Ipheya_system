<?php

	session_start();
    if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
		include('includes/head.php');
		// include('includes/navigation.php');
		// include('includes/employee-session.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>

<body>
    <link href='../assets/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='../assets/plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='../assets/plugins/moment/moment.min.js'></script>
    <script src='../assets/plugins/fullcalendar/lib/jquery.min.js'></script>
    <script src='../assets/plugins/fullcalendar/fullcalendar.min.js'></script>  
    <div class="wrapper">
        <?php include 'includes/sidebar.php'?>
        <div id='content'>
            <div class='row'>
                <div class="col-xs-12">
                    <div id='calendar' class="col-xs-6 b">
                    </div>
                </div>  
            </div>
        </div>
    </div>
  <?php include('includes/footer.php'); ?>
  <script>
    $(document).ready(function(){
        $('#calendar').fullCalendar({
            header:{
                left:'prev,next today',
                center: 'title',
                right : 'month, agendaWeek, agendaDay,listWeek'
            },
            defaultDate: '2017-08-12'
        });
    });
  </script>
</body>