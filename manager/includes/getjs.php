<?php
    include'../../core/logic.php';


    $log = new Logic();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query ="SELECT * FROM `programs` WHERE `id` =".$id;
        $data ='no data';
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result)):
            $data = $program;
        endwhile;

        if($data =='no data')
        {
            $data='Error';
        }

        echo json_encode($data);
    }
?>