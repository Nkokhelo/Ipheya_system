<?php
    include'../../core/logic.php';


    $log = new Logic();
    if(isset($_GET['department']))
    {
        $id = $_GET['department'];
        $data = array();
        $result = $log->getallEmployees();
        while($program  = mysqli_fetch_assoc($result))
        {
          if($program['department'] == $id)
          {
              $data=$program;
          }
        }
        if($data =='')
        {
            $data='Error';
        }
        echo json_encode($data);
    }
?>