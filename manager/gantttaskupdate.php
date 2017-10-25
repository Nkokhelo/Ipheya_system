<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/task-edit-controller.php');
        // include('includes/navigation.php');
        //mfudo...
   }
   else
   {
     header("Location:../login.php");
   }
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-11 b'>
              <div class="col-xs-8">
                <form class="form" action="" method="POST">
                    <legend class="inlegend thelegend">
                          Task information
                    </legend>
                    <div class="form-group col-sm-6">
                      <label for="name">Task title</label>
                      <input type="text" class="form-control" name="name" id="name" value="<?=((isset($name))?$name:'');?>" placeholder="Task name" required>
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="location">Task location</label>
                      <input type="text" id="location" onkeyup='search_place()' class="form-control" value="<?=((isset($location))?$location:'');?>" name="location" placeholder="Pick a location!" required>
                    </div>
                    <!--Weather has to be fixed-->
                    <div id="weather" class="col-sm-12 gllpMap  " style=" height:300px; ">
                      <iframe id="forecast_embed" type="text/html" frameborder="0" height="245"width="100%"
                        src="http://forecast.io/embed/#lat=-29.850148&lon=31.007463&name=South-Africa:Durban">
                      </iframe>
                    </div>
                    <!--Map-->
                    <div class="col-sm-12 col-md-12 form-group" id='con'>
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
                    <div class="form-group col-sm-12">
                      <input type="submit" class="btn btn-info form-control" name="Update" value="Update task">
                    </div>
               </form>
              </div>
              <div class="col-xs-4">
                  <legend class="inlegend thelegend">
                    Assign task to employees
                  </legend>
                  <form method="post">
                  <div class="form-group">
                    <label for="select">Select employee(s)</label>
                    <select name="employee[]" id="select" class="form-control" multiple>
                      <?=$selectemp;?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-info form-control" name="Assign" value="Assign Employees">
                  </div>
                </form>
                <table class="table table-striped">
                  <thead>Employees on task</thead>
                  <thead>
                    <td></td>
                    <td>Name</td>
                    <td>Surname</td>
                    <td>Remove</td>
                  </thead>
                  <tbody>
                    <?=$emplist;?>
                  </tbody>
                </table>
                  <!--<nav id="">
                    <ul class="list-unstyled components">
                      <li><a href="">list</a></li>
                      <li><a href="">list</a></li>
                      <li><a href="">list</a></li>
                      <li><a href="">list</a></li>
                      <li><a href="">list</a></li>
                      <li><a href="">list</a></li>
                    </ul>
                  </nav>-->
              </div>
             </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWOMyEmxZVyeidLLRrsdIH-Mb_zAaF7cM&callback=myMap"></script>
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
      $('#select').select2();
  </script>
</body>
