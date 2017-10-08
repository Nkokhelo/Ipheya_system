<?php
    header('Access-Control-Allow-Origin: *');
    include '../logic.php';
    $logic = new Logic();

    if(isset($_GET['allemployees']))
    {
        $data['employees']='';
        $data['employees']= $logic->allEmployees();
        echo json_encode($data);
    }

    if(isset($_GET['alltasks']))
    {
      $data['alltasks']='';
      $data['alltasks'] = $logic->allTasks();
      echo json_encode($data);
    }

    if (isset($_GET['allobservations']))
    {
      $data['allobservations'] = '';
      $data['allobservations'] = $logic->allObsevations();
      echo json_encode($data);
    }

    if (isset($_GET['allPosts']))
    {
      $data['trainings'] = '';
      $data['trainings'] = $logic->allTrainings();
      echo json_encode($data);
    }
?>
