<?php
  $q ="SELECT DISTINCT ei_date, SUM(ei_amount) as montly FROM expense_income where e_or_i='i' GROUP BY ei_date";

?>
<?php
    require_once('../init.php');
    require('../logic.php');
    $logic = new Logic();
    header('Content-Type: application/json');
    $data='';
    //  ob_start();
    if(isset($_GET['expenses']))
    {
       $view ="SELECT DISTINCT ei_date, SUM(ei_amount) as amount FROM expense_income where e_or_i='i' GROUP BY ei_date"; 
       $result = mysqli_query($db,$view);       
       $data = '[';
       while($row = mysqli_fetch_assoc($result))
       {
        //  echo $row['amount'];
         $data .='{"date":"'.$row['ei_date'].'","amount":"'.$row['amount'].'"},';
       }
       $data =rtrim($data,",");
       $data .=']';
       echo $data;
      //  ob_end_clean();
       mysqli_close($db);
       #print data
    }
 ?>

