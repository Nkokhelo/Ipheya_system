<?php
    header('Access-Control-Allow-Origin: *');
    include '../logic.php';
    $logic = new Logic();

 if(isset($_GET['allemp']))
{
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
