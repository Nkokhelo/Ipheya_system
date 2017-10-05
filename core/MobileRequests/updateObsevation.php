<?php
  header('Access-Control-Allow-Origin: *');

      if(isset($_POST))
      {
          include '../logic.php';
          $log = new Logic();
          $valid['success'] = array('success' => false, 'messages' => array());          
          $connect = $log->connect();
          $data ="";
          $mobileData = json_decode(file_get_contents('php://input'));

          $data = $mobileData;
          $query = $connect->query("UPDATE observation_task SET complete = $data->complete WHERE task_id = $data->id");
          if($query == true)
          {
           $valid['success'] = true;
           $valid['messages'] ="Updated succesful";
          }
          
           echo json_encode($valid);
      }
?>