<?php
  // include('../core/logic.php');
  // $logic = new Logic();
  $query =$logic->getallProjets();
  $nt=$np=$tp=$tc=$to=$pp=$pc=$po=$totp=$tott=0;

  while($projects = mysqli_fetch_assoc($query))
  {
   $totp++;
    if($projects['status']=='inprogress')
    {
      $pp++;
    }
    else if($projects['status']=='complete')
    {
      $pc++;
    }
    else if($projects['status']=='overdue')
    {
      $po++;
    }
    else
    {
     $np++;
    }
  }
  //get all tasks
  $query = $logic->getallTasks();
  while($projects = mysqli_fetch_assoc($query))
  {
   $tott++;
    if($projects['status']=='inprogress')
    {
      $tp++;
    }
    else if($projects['status']=='complete')
    {
      $tc++;
    }
    else if($projects['status']=='overdue')
    {
      $to++;
    }
    else
    {
     $nt++;
    }
  }



?>
