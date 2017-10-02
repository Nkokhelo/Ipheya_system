<?php
   #21539288 POLELA AL
   session_start();
   if(isset($_SESSION['Employee']))
   {
     require('../core/init.php');
     include('includes/head2.php');
     include('../core/controllers/geolocation-controller.php');
   }
   else
   {
     header("Location:../login.php");
   }

    //  include('includes/employee-session.php');
?>

<body>
  <style>
      /*
       * To see in action, go to http://jsfiddle.net/seydoggy/9jv5e8d1/
       */
      .panel.panel-horizontal {
          display:table;
          width:100%;
      }
      .panel.panel-horizontal > .panel-heading, .panel.panel-horizontal > .panel-body, .panel.panel-horizontal > .panel-footer {
          display:table-cell;
      }
      .panel.panel-horizontal > .panel-heading, .panel.panel-horizontal > .panel-footer {
          width: 25%;
          border:0;
          vertical-align: middle;
      }
      .panel.panel-horizontal > .panel-heading {
          border-right: 1px solid #ddd;
          border-top-right-radius: 0;
          border-bottom-left-radius: 4px;
      }
      .panel.panel-horizontal > .panel-footer {
          border-left: 1px solid #ddd;
          border-top-left-radius: 0;
          border-bottom-right-radius: 4px;
      }
  </style>
  <div class="wrapper">
      <?php include('includes/sidebar2.php');?>
      <div id='content'>
        <div class="container-fluid" style="margin-top:40px">
          <div class="row">
            <div id="wrap">
                <div class="panel panel-info panel-horizontal">
                    <div class="panel-heading">
                         <h3 class="panel-title col-md-4">Team Location</h3>
                    </div>
                    <div class="panel-body col-md-8">Task information</div>
                </div>
            </div>
            <?=$locations;?>
       </div>
       div.hello>ul#list>li*5
      </div>
  </div>
  <script src = "../assets/lib/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_J9n6vtDJfK5aaa6aA2alI-sbCqRL7yA&sensor=false"></script>
  <script type="text/javascript">
  <?php
  $x=0; $y=1;
   while($x<$id): ?>
  $(function(){
    navigator.geolocation.getCurrentPosition(success, error);

    function success(position){
      //getting the coordinates
      var lat = "<?=$lat[$x];?>";//position.coords.latitude;
      var long = "<?=$long[$x];?>";//position.coords.longitude;

      $('latitude').html(lat);
      $('longitude').html(long);

      var latlon = new google.maps.LatLng(lat,long);
      //create map
      var mapOptions = {
         zoom: 14,
         center: latlon,
         mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map =  new google.maps.Map(document.getElementById("maps<?=$y;?>"), mapOptions);

      var marker = new google.maps.Marker({
        position: latlon,
        map: map,
        title: "I was Here",
        draggable: true,
        animation: google.maps.Animation.BOUNCE
      });
    }
    function error(){
      $('maps<?=$y;?>').html("Your network connection was interrupted");
    }
  });
  <?php
  $x++; $y++;
  endwhile; ?>
  </script>
</body>
