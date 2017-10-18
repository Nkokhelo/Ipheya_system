<?php

require_once 'core.php';

$rentlist = $_POST['clientRentals'];
$row=array();
$row = $rentlist;
$connect->close();
// session_start();
$_SESSION['rent_items'] = $row;
echo print_r($_SESSION['rent_items']);
?>