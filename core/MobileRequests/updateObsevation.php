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
          $obsevationq = $connect->query("SELECT * FROM observation_task WHERE task_id =".$data->id);
          $success = false;
          $messages ='';
          if(!$obsevationq)
          {
            $obs ="Error".$connect->error;
          }
          else
          {
              $obs = $obsevationq->fetch_assoc();
          }
          if($data->complete == 100)
          {
              $query = $connect->query("UPDATE observation_task SET complete = $data->complete, status = 'observed' WHERE task_id = $data->id");
              if($obs['r_type']=='Service')
              {
                $query = $connect->query("UPDATE servicerequest SET RequestStatus = 'observed' WHERE RequestID = ".$obs['request_id']);
                if(!$query)
                {
                    $messages ="Update servicerequest error";
                }
                
              }
              else
              {
                $query = $connect->query("UPDATE maintenancerequest SET RequestStatus = 'observed' WHERE RequestID =".$obs['request_id']);
                if(!$query)
                {
                    $messages ="Update maintenancerequest error";
                }


                
                
              }
          }
          else
          {
              $query = $connect->query("UPDATE observation_task SET complete = $data->complete WHERE task_id = $data->id");
          }
          if($query == true)
          {
           $success = true;
           $messages ="Updated!!!";           
           $valid['success'] = $success;
           $valid['messages'] =$messages;
          }
           echo json_encode($valid);
      }
?>