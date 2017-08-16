<?php
    include'../../core/logic.php';


    $log = new Logic();
    if(isset($_GET['department']))
    {
        $id = $_GET['department'];
        $query ="SELECT * FROM `services` WHERE `department` =".$id;
        $data ='';
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result))
        {
            $data=$program;

        }
        if($data =='')
        {
            $data='Error';
        }
        echo json_encode($data);
    }
?>