<?php session_start(); ?>

<?php
     require_once '../core/logic.php';
     $log= new Logic();
     $method = $log->connect();
     if(!isset($_SESSION['score']))
     {
         $_SESSION['score'] = 0;
     }
     if(!isset($_SESSION['count']))
     {
         $_SESSION['count'] = 0;
     }
   
    if(isset($_POST['next-question']))
    {
        if(!isset($_SESSION['score']))
        {
            $_SESSION['score'] = 0;
        }
        if(!isset($_SESSION['count']))
        {
            $_SESSION['count'] = 0;
        }
       $test_id = $_POST['test-id'];
       $question_number = $_POST['question-number'];
       if(isset($_POST['choice']))
       {
           $question_answer = $_POST['choice'];
       }
       else
       {
        $question_answer =0;
       }
       $totalq = $method->query("select count(*) as total from question where test_id='$test_id'");
       $total = $totalq->fetch_assoc();
       $correct_answerq = $method->query("select choice_id from choices where question_id='$question_number' and is_correct=1");
       $correct_answer = $correct_answerq->fetch_assoc();
        
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
           $results = ($_SESSION['score']/$total['total'])*100;
           header("Location:question.php?test=".$test_id);
           exit();
       }
        

    }
    