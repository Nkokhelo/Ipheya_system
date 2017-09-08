<?php
#21408789 Zulu NP
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
        if(getimagesize($_GET['image'])==FALSE)
        {
            die("Please select an image");
        }
        else
        {
            $file =base64_encode($_GET['image']);
            $sqlQ = "UPDATE surveying SET RequestID = $redId,Description = '$des',Image = '$file' WHERE SurveyingID = $id";
            if(!mysqli_query($log->connect(),$sqlQ))
            {
                die('error'.mysqli_error($log->connect()));
            }
        }

    }
    if(isset($_POST["submit"]))
	{

		$obs="Select RequestID from Surveying Where RequestID='$_POST[reqID]'";
        if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
        {
            die("Please select an image");
        }
        else
        {
			$image=addslashes($_FILES['image']['tmp_name']);
			$image=file_get_contents($image);
			$image=base64_encode($image);
            $insert="Insert into Surveying (RequestID,Description,Image) Values('$_POST[reqID]','$_POST[discr]','$image')";
            if(!mysqli_query($log->connect(),$insert))
            {
                echo('Error');
            }
            $departments = $_POST['departments'];
            
            if(!empty($departments))
            {
                foreach($departments as $department)
                {
                    $save ="";
                }
            }
            header('Location:View.php');
        }

	}

    $surveyingList='';
    $sqlresult = $log->getallSuveyingInfo();
    while($suveys = mysqli_fetch_row($sqlresult))
    {
        $surveyingList.= "<tr>
                                <td>$suveys[1]</td>
                                <td>$suveys[2]</td>
                                <td><img src='data:image;base64,$suveys[3]' height='40px' width='40px'/></td>
                                <td id='actions'>
                                        <a data-toggle='modal' class='btn btn-sm btn-default' id=".$suveys[0]."  href='#Dmodal' >Delete</a>
                                        <a data-toggle='modal' class='btn btn-sm btn-default' id=".$suveys[0]." href='#Smodal'>Edit</a>
                                </td>
                           </tr>";
    }

?>