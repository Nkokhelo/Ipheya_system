<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
      require_once('../core/init.php');
      include('../core/logic.php');
      include('includes/head2.php');
      require_once('../core/controllers/adash-controller.php');
    }
    else
    {
      header("Location:../login.php");
    }
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php';?>
      <div id='content'>
        <div class='row'>
         <div class='col-xs-11 b'>
         <h3 class="text-center">Welcome </h3>
         <hr class="bhr"/>
         <div class="col-xs-12">

          <div class="row">
            
            <div class="col-xs-4">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <a href="product.php" style="text-decoration:none;color:black;">
                    Total Product
                    <span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
                  </a>
                  
                </div> <!--/panel-hdeaing-->
              </div> <!--/panel-->
            </div> <!--/col-xs-4-->

              <div class="col-xs-4">
                <div class="panel panel-info">
                <div class="panel-heading">
                  <a href="orders.php?o=manord" style="text-decoration:none;color:black;">
                    Total Orders
                    <span class="badge pull pull-right"><?php echo $countOrder; ?></span>
                  </a>
                    
                </div> <!--/panel-hdeaing-->
              </div> <!--/panel-->
              </div> <!--/col-xs-4-->

            <div class="col-xs-4">
              <div class="panel panel-danger">
                <div class="panel-heading">
                  <a href="product.php" style="text-decoration:none;color:black;">
                    Low Stock
                    <span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
                  </a>
                  
                </div> <!--/panel-hdeaing-->
              </div> <!--/panel-->
            </div> <!--/col-xs-4-->

            <div class="col-xs-4">
              <div class="card">
                <div class="cardHeader">
                  <h1><?php echo date('d'); ?></h1>
                </div>

                <div class="cardContainer">
                  <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
                </div>
              </div> 
              <br/>

              <div class="card">
                <div class="cardHeader" style="background-color:#245580;">
                  <h1><?php if($totalRevenue) {
                    echo $totalRevenue;
                    } else {
                      echo '0';
                      } ?></h1>
                </div>

                <div class="cardContainer">
                  <p> <i class="glyphicon glyphicon-usd"></i> Total Revenue</p>
                </div>
              </div> 

            </div>

            <div class="col-xs-8">
              <div class="panel panel-default">
                <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
                <div class="panel-body">
                  <div id="calendar"></div>
                </div>	
              </div>
              
            </div>

            
          </div> <!--/row-->

         </div>
        </div>
        </div>
        <?php include('includes/footer.php'); ?>
        <?php #include('includes/chat.php'); ?>
      </div>
  </div>
</body>
<script src="../assets/fullcalendar/js/jquery-1.10.2.js"></script>
<script src="../assets/fullcalendar/js/bootstrap.min.js"></script>
<script src='../assets/fullcalendar/js/moment.min.js'></script>
<script src='../assets/fullcalendar/js/fullcalendar.js'></script>
<link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.css">

<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var today = moment(Date()).format("YYYY-MM-DD");

      $('#calendar').fullCalendar({
        theme: true,
        header:{
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
        }
        });


    });
</script>
