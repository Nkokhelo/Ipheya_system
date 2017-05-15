<?php
#list of all survying information
 $log = new Logic();
 $sqlSquery = $log->getallServiceRequest();
 $surveyingOptions="";
	while($arrReq=mysqli_fetch_row($sqlSquery))
    {
        $surveyingOptions.= "<option value='$arrReq[0]'>$arrReq[1]</option>";
    }

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sqliquery ="DELETE FROM Surveying WHERE SurveyingID=$id";
        mysqli_query($log->connect(),$sqliquery);

    }

    if(isset($_GET['editv']))
    {
        $id = $_GET['editv'];
        $redId = $_GET['reqID'];
        $des = $_GET['discr'];
        $file =$_GET['image'];
        $sqlQ = "UPDATE surveying SET RequestID = $redId,Description = '$des',Image = '$file' WHERE SurveyingID = $id";
        if(!mysqli_query($log->connect(),$sqlQ))
        {
            die('error'.mysqli_error($log->connect()));
        }

    }
    $surveyingList='';
    $sqlresult = $log->getallSuveyingInfo();
    while($suveys = mysqli_fetch_row($sqlresult))
    {
        $surveyingList .= "<tr><td>$suveys[1]</td><td>$suveys[2]</td><td><img src='$suveys[3]' height='20px' width='20px'/></td>
                                    <td id='actions'>
                                        <a data-toggle='modal' class='btn btn-sm btn-default' id=".$suveys[0]."  href='#Dmodal' >Delete</a>
                                        <a data-toggle='modal' class='btn btn-sm btn-default' id=".$suveys[0]." href='#Smodal'>Edit</a>
                                    </td>
                            </tr>";
    }

?>