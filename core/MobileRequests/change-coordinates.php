<?php
    require_once('../init.php');
    $lat = mysqli_real_escape_string($db,$_POST['latitude']);
    $long = mysqli_real_escape_string($db,$_POST['longitude']);
    mysqli_query($db, "UPDATE geolocation SET latitude = '$lat', longitude = '$long' WHERE employee_id = 1");
 ?>
