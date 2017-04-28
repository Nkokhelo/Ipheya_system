<?php
    $db = mysqli_connect('localhost','root','','ipheya');
    if(mysqli_connect_errno()){
      echo "Database connection failed with following error(s): ".mysqli_connect_errno();
      die();
    }
    #require_once($_SERVER['DOCUMENT_ROOT'].'/walk-about/config.php');
    require_once('helpers.php');
 ?>
