<?php
    include'../../core/logic.php';
    $log = new Logic();
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $sqliquery ="SELECT * FROM Surveying WHERE SurveyingID=$id";
        $qr =mysqli_query($log->connect(),$sqliquery);
        if(!$qr)
        {
            die('Error '.mysqli_error($log->connect()));
        }
        $sqlSquery = $log->getallServiceRequest();
          
         $desc='';
         $val='';
         $file='';
        while($arr = mysqli_fetch_row($qr))
        {
            $file=$arr[3];
            $val=$arr[1];
            $desc=$arr[2];
            $request = "";
            $selected="";
            while($allrequest = mysqli_fetch_row($sqlSquery))
                {
                    if($arr[1]==$allrequest[0])
                    {
                        $selected ='selected';
                    }
                    $request.="<option $selected>$allrequest[0]</option>";
                    $selected="";
                };
            $desc="<div class='modal-body bhr'>
                            <div class='form-group'>
                                <label for='reqID'>Request id</label>
                                <select class='form-control' name='reqID' id='reqID'  required>".$request."</select>
                            </div>
                            <div class='form-group'>
                                <label for='discr'>Description</label>
                                <textarea name='discr' id='discr' class='form-control' rows='5' cols='40' placeholder='Enter Discription' required>".$arr[2]."</textarea>
                            </div>
                            <div class='form-group'>
                                <label for='image'>Photos</label>
                                <input type='file' name='image' id='image'  required value='".$arr[3]."'/>
                            </div>
                            <input type='hidden' name='editv' value='".$_GET['edit']."'/>
                    </div>
                    <div class='modal-footer'>
                        <input type='submit' class='btn btn-success' name='submit' value='Update'/>
                    </div>";
        }
       echo $desc;
    }
?>