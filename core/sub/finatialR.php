
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
                  <p> <b>From</b>'.date_format(date_create($event['start']),"d F Y").' <b>to</b>'.date_format(date_create($event['end']),"d F Y").'</p></br>
                </div>
                  <div class="modal-footer">
                    <form id="subscribe" method="post" class="form-group subscribe-area">
                    <input type="hidden" name="event_id" value="'.$id.'"/>
                    <button type="submit" name="event_booking" class="btn btn-primary" >
                    <i class="fa fa-check-square-o"></i> Book this event </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>';
                echo $data;
    }
    if(isset($_GET['uevent_data']))
    {
      $id=$_GET['uevent_data'];
      $event = $logic->getEventbyID($id);
      $data =' <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1 class="modal-title text-center">'.$event['title'].'</h1>
                </div>
                <div class="modal-body">
                  <p>'.$event['description'].'</p></br>
                  <p> <b>From</b>'.date_format(date_create($event['start']),"d F Y").' <b>to</b>'.date_format(date_create($event['end']),"d F Y").'</p></br>
                </div>
                <div class="modal-footer">
                  <form class="form-inline" method="post">
                    <div class="form-group">
                      <input type="hidden" name="event_id" value="'.$id.'"></input>
                      <input type="text" class="form-control" placeholder="Name" name="name" required id="name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email Address" name="email" required id="email">
                    </div>
                    <button type="submit" class="btn btn-primary" name="oevent_booking"><i class="fa fa-check-square-o"></i>Book</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
                </div>';
                echo $data;
    }
 ?>

