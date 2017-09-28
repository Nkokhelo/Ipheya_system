<?php
$logic =new logic();
$feedback="";
if(isset($_POST['submit']))
{
$timeline=$_POST['timeline'];
$query="INSERT INTO timelines('timeline_id','timeline') VALUES(NULL,'$timeline')";
if(!$result)
{
        $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Error!</strong>'.mysqli_error($db));
}
else
{
      $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong> Project saved !');
}

}
?>