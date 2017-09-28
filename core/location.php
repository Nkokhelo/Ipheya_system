<?php
    $con = mysqli_connect('localhost','root','','ipheya');

    #temporary client account
    $sql = "CREATE TABLE location
    (
      location_id int NOT NULL AUTO_INCREMENT,
      PRIMARY KEY(location_id),
      employee_id int,
      latitude varchar(100),
      longitude varchar(100)
    )";
    if(mysqli_query($con, $sql))
    {
      echo '{{location Created}}<br>';
    }
    else{
      echo '{{location not created: '.mysqli_error($con).'}}<br>';
    }
?>
