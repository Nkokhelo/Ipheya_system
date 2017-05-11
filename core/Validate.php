<?php

   include('test.php');

$Subject=$RequestType=$ProblemDescription="";


if($_SERVER["Request_Method"]=="Post")
{
    $Subject=test_input($_POST["Subject"]);
    $RequestType=test_input($_POST["RequestType"]);
    $ProblemDescription=test_input($_POST["ProblemDescription"]);
}
function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
       
?>
