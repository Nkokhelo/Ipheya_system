
<?php
    require_once('../init.php');
    require('../logic.php');
    $logic = new Logic();
    header('Content-Type: application/json');
    $data='';
    //  ob_start();
    if(isset($_GET['expenses']))
    {
      $data = '[';
       $view ="SELECT DISTINCT ei_date, SUM(ei_amount) as amount, e_or_i FROM expense_income where e_or_i='e' GROUP BY ei_date"; 
       $result = mysqli_query($db,$view);       
       while($row = mysqli_fetch_assoc($result))
       {
        //  echo $row['amount'];
         $data .='{"date":"'.date_format(date_create($row['ei_date']),'F Y').'","amount":"'.$row['amount'].'","type":"'.$row['e_or_i'].'"},';
       }
       $data =rtrim($data,",");
       $data .=']';
       echo $data;
      //  ob_end_clean();
       mysqli_close($db);
       #print data
    }
    if(isset($_GET['incomes']))
    {
       $view ="SELECT DISTINCT ei_date, SUM(ei_amount) as amount FROM expense_income where e_or_i='i' GROUP BY ei_date"; 
       $result = mysqli_query($db,$view);       
       $data = '[';
       while($row = mysqli_fetch_assoc($result))
       {
        //  echo $row['amount'];
         $data .='{"date":"'.date_format(date_create($row['ei_date']),'F Y').'","amount":"'.$row['amount'].'"},';
       }
       $data =rtrim($data,",");
       $data .=']';
       echo $data;
      //  ob_end_clean();
       mysqli_close($db);
       #print data
    }
    if(isset($_GET['event_data']))
    {
      $id=$_GET['event_data'];
      $event = $logic->getEventbyID($id);
      $data =' <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1 class="modal-title text-center">'.$event['title'].'</h1>
                </div>
                <div class="modal-body">
                  <p>'.$event['description'].'</p></br>
                  <p> <b>From</b>'.date_format(date_create($event['start']),"d F Y").'-<b>to</b>'.date_format(date_create($event['end']),"d F Y").'</p></br>
                </div>
                <div class="modal-footer">
                  <div class="subscribe">
                  <h5>Subscirbe for this event</h5>
                    <form id="subscribe" class="form-group subscribe-area">
                      <input type="email" name="subscribe-email" id="st-email" class="form-control subscribe-box" placeholder="Enter your email...">
                      <button type="submit" name="subscribe-submit" class="btn btn-primary btn-lg submit-bt" >Subscribe</button>
                      <br>
                      <label for="st-email" class="st-subscribe-message"></label>
                    </form>
                  </div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>';
                echo $data;
    }
 ?>

