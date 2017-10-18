<?php
  include 'includes/head2.php';
  include('../core/init.php');
  include('../core/logic.php');
  // include('../core/controllers/training-controller.php');
  $logic = new Logic();  
  $method = $logic->connect();
  $connect = $logic->connect();
  
  ?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>

      <div id='content'>
        <div class='row'>

              
            <div class='col-xs-6'>
             <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="allemployees.php"> <i class="fa fa-users"></i> All EMployees</a></li>
                <li><a href="alltrainings.php"> <i class="fa fa-laptop"></i> Trainings</a></li>
                <li><a href="test.php"> <i class="fa fa-check-square"></i> Tests</a></li>
                <li class="dropdown active">Add Qouestions</li>
             </ol>
        </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
               <h2>Test Settings</h2><hr class="bhr"/>
               <div class="col-xs-12">
               <?php

                if(isset($_POST['add-question']))
                {
                    $question = $_POST['test-question'];
                    $testid = $_POST['test-id'];
                    $res = $method->query("INSERT INTO `question`(`question_id`, `test_id`, `question_text`) VALUES (NULL,'$testid','$question')");
                    if($res)
                    {
                        echo $logic->display_success("Question Added");
                    }else
                    {
                        echo $logic->display_error("Could not add question. Try again");
                    }
                }else if(isset($_POST['add-choices']))
                {
                    $choices = array();
                    $question_id = $_POST['question-id'];
                    $correct = $_POST['correct-choice'];

                    $choices[1] = $_POST['choice1'];
                    $choices[2] = $_POST['choice2'];
                    $choices[3] = $_POST['choice3'];
                    $choices[4] = $_POST['choice4'];
                    
                    foreach($choices as $choice=>$value)
                    {
                        if($value!= '')
                        {
                            if($correct == $value)
                            {
                                $is_correct = 1;
                            }
                            else
                            {
                                $is_correct = 0;
                            }
                           $res = $method->query("INSERT INTO `choices`(`choice_id`, `question_id`, `choice_text`, `is_correct`) VALUES (NULL,'$question_id','$value','$is_correct')");
                            if($res)
                            {
                                echo $logic->display_success("Question Added");
                            }
                            else
                            {
                                echo $logic->display_error("Could not add choices. try again.");
                            }
                        }
                    }
                }
               ?>
               <div class="card">
                   <div class="header">
                       <h4 class="text-left">Add Test Questions</h3><hr/>
                       <div class="clearfix"></div>
                   </div>
                   <div class="content" style="text-align:left">
                      <form method="post">
                           <div class="row">
                               <div class="col-xs-6">
                                   <div class="form-group">
                                       <label>Test Name</label>
                                       <select name="test-id" class="form-control">
                                        <option>Select Test</option>
                                       <?php
                                           $testlist = $method->query("select t.test_id, t.test_name as testname,tr.tname from test t, training tr where t.training_id=tr.trainingId");
                                           while($test = $testlist->fetch_assoc())
                                                  {?>
                                                      <option value="<?php echo $test['test_id']?>"><?php echo $test['testname']?> - <?php echo $test['tname']?></option>
                                                  <?php }
                                              ?>
                                       </select>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                              <div class="col-xs-8">
                                   <div class="form-group">
                                       <label>Question</label>
                                       <input type="text" class="form-control" name="test-question" required/>
                                   </div>
                               </div>
                           </div>
                           <hr>
                           <button type="submit" class="btn btn-info btn-fill" name="add-question">Add Question</button>
                       </form>
                   </div>
               </div>
               <hr class="bhr">
               <div class="card">
                   <div class="header">
                       <h4 class="text-left">Add Question Choices</h3><hr/>
                       <div class="clearfix"></div>
                   </div>
                   <div class="content" style="text-align:left">
                      <form method="post">
                           <div class="row">
                               <div class="col-xs-6">
                                   <div class="form-group">
                                       <label>Choose Question</label>
                                       <select name="question-id" class="form-control">
                                        <option>Select Question</option>
                                       <?php
                                           $tests = $method->query("select question_id,question_text from question");
                                           while($test=$tests->fetch_assoc())
                                           {?>
                                               <option value="<?php echo $test['question_id']?>"><?php echo $test['question_text']?></option>
                                           <?php }
                                       ?>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-xs-6">
                                   <div class="form-group">
                                       <label>Correct Choice</label>
                                       <select name="correct-choice" class="form-control">
                                           <option>Select correct choice</option>
                                           <option value="1">Choice 1</option>
                                           <option value="2">Choice 2</option>
                                           <option value="3">Choice 3</option>
                                           <option value="4">Choice 4</option>
                                       </select>
                                   </div>
                               </div>
                           </div>
                           <div class="row" style="text-align:left">
                               <div class="col-xs-12">
                                   <div class="form-group">
                                       <label>Choice 1</label>
                                       <input type="text" class="form-control" name="choice1"/>
                                   </div>
                               </div>

                               <div class="col-xs-12">
                                   <div class="form-group">
                                       <label>Choice 2</label>
                                       <input type="text" class="form-control" name="choice2"/>
                                   </div>
                               </div>

                               <div class="col-xs-12">
                                   <div class="form-group">
                                       <label>Choice 3</label>
                                       <input type="text" class="form-control" name="choice3"/>
                                   </div>
                               </div>

                               <div class="col-xs-12">
                                   <div class="form-group">
                                       <label>Choice 4</label>
                                       <input type="text" class="form-control" name="choice4"/>
                                   </div>
                               </div>
                           </div>
<hr>
                           <button type="submit" class="btn btn-info btn-fill" name="add-choices">Add Question</button>
                           <div class="clearfix"></div>
                       </form>

                   </div>
                   
               </div>
           </div>

               </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
