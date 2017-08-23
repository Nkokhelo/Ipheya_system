<?php
    $db = mysqli_connect('localhost','root','','ipheya');
    if(mysqli_connect_errno())
    {
      echo "Database connection failed with following error(s): ".mysqli_connect_errno();
      die();
    }
    #require_once($_SERVER['DOCUMENT_ROOT'].'/walk-about/config.php');
    require_once('helpers.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
 ?>
