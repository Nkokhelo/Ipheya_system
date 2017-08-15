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
<<<<<<< HEAD
=======

>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
        echo json_encode($data);
    }
?>