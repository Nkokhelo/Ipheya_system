<?php
    header('Access-Control-Allow-Origin: *');

 if(isset($_GET['allemp']))
{
    include '../logic.php';
    $logic = new Logic();
    $data='';
    $responce = $logic->getallEmployees();
    while ($th = mysqli_fetch_assoc($responce))
    {
        $data .=json_encode($th).",";
    }
    $data=rtrim($data,",");
    echo $data;
}
?>