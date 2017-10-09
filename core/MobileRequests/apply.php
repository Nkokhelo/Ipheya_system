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
            $connect = $log->connect();
            $data ="";
            $mobileData = json_decode(file_get_contents('php://input'));
            $training_id = $mobileData->trainging_id;
            $username = $mobileData->email;

            $q ="SELECT * FROM employees WHERE email ='".$username."'";
            $r = mysqli_query($connect,$q);
            if(!$r)
            {
             $data = $q;
            }
            else
            {
             $emp_id = mysqli_fetch_assoc($r)['employee_id'];
             $data ="Error";
             if($emp_id!=null)
             {
              $resul = $connect->query("SELECT * FROM training_employee WHERE employee_id= ".$emp_id." AND training_id = ".$training_id);
              if($resul->fetch_row() > 0)
              {
                $data="You have already applied for this training";
              }
              else
              {
               $sql = "INSERT INTO `training_employee`(`id`,`employee_id`,`training_id`) 
                VALUES(NULL, $emp_id, $training_id)";
                if(!$connect->query($sql))
                {
                 $data = "Error";
                }
                else
                {
                 $data = "Your booking was successfull";
                }
              }
              // $data ="good";
             }
             else
             {
              $data = "Please login";
             }
            }
            echo json_encode($data);
        }
?>
