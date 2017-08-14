<?php
    include '../../core/logic.php';
    $logic = new Logic();

    if(isset($_GET['item_no']))
    {
        $error=$data="";
        $query ="SELECT * FROM `qoutationitems` WHERE `QoutationItemID`=".$_GET['item_no'];
        $execute = mysqli_query($logic->connect(),$query);
        if(!$execute)
        {
            $error='Error'.mysqli_error($logic->connect());
            echo $error;
            exit;
        }
        else
        {
            while($item = mysqli_fetch_assoc($execute)):
                $data = $item;
            endwhile;
            echo json_encode($data);
        }
    }
?>