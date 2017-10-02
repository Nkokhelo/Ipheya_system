<?php
   $sql = mysqli_query($db, "SELECT * FROM geolocation");
   $locations  = ''; $id = 0;
   $mapholderArgs = $lat = $long = array();
   while($loc = mysqli_fetch_assoc($sql)):
      $id += 1;
      $locations .= '<div id="wrap">
                      <div class="panel panel-info panel-horizontal">
                          <div class="panel-heading" id="maps'.$id.'" style="height:200px;">
                          </div>
                          <div class="panel-body col-md-8">
                            <address id="address'.$id.'">

                            </address>
                          </div>
                      </div>
                  </div>';
                  $mapholderArgs[] .= 'maps'.$id;
                  $lat[] .= $loc['latitude'];
                  $long[] .=$loc['longitude'];
   endwhile;
 ?>
