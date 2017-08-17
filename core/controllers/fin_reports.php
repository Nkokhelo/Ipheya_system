<?php
    $count = "SELECT productline, count(*)
    FROM products
    GROUP BY productline";
    $result = 
?>