<?php
  $db = mysqli_connect('localhost','root','','ipheya');
  if(!$db)
  {
    die("Failed to connect");
  }
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
?>
