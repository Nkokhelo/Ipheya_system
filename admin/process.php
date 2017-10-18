<?php session_start(); ?>
<?php
     require_once '../core/logic.php';
     $log= new Logic();
     $method = $log->connect();

    if(!isset($_SESSION['score']))
    {
        $_SESSION['score'] = 0;
    }
    if($_POST)
    {
       $test_id = $_POST['test-id'];
       $question_number = $_POST['question-number'];
       $question_answer = $_POST['choice'];
        
       $total = $log->select("select count(*) as total from question where test_id='$test_id'");
       $correct_answer = $log->select("select choice_id from choices where question_id='$question_number' and is_correct=1");

       if($correct_answer['choice_id']==$question_answer)
       {
           $_SESSION['score']++;
       }
       if($total['total']==$_SESSION['count']+1)
       {
           header("Location:result.php?test=".$test_id);
           exit();
           
       }else
       {
           $_SESSION['count']++;
           header("Location:question.php?test=".$test_id);
           exit();
       }
        

    }
    