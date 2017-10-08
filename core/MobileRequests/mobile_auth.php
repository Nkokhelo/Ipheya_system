<?php
    // header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: POST,GET,OPTIONS,PUT,DELETE');
    // header('Access-Control-Allow-Credentials: true');
    // header('Content-Type: application/json');
        if(isset($_POST))
        {
            include '../logic.php';
            $log = new Logic();
            $data ="";
            $mobileData = json_decode(file_get_contents('php://input'));
            $query = $log->Login($mobileData->username,$mobileData->password);
            // // $query = $log->Login("Admin@gmail.com","Admn@2017");
              while($user =  mysqli_fetch_assoc($query))
              {
                  $data = $user;
              }
             echo json_encode($data);
        }
?>
