
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
            <div class='col-xs-12'>

                   <div class='col-xs-12'>
                    <ol class="breadcrumb">
                       <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                       <li><a href="allemployees.php"> <i class="fa fa-users"></i> All EMployees</a></li>
                       <li><a href="alltrainings.php"> <i class="fa fa-laptop"></i> Trainings</a></li>
                       <li><a href="test.php"> <i class="fa fa-check-square"></i> Tests</a></li>
                       <li class="dropdown active">Add Qouestions</li>
                    </ol>
               </div><!-- /col-xs-6-->
               <div class="col-xs-11 b">
               <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <?php
                                    if(!isset($_SESSION['count']))
                                    {
                                         $_SESSION['count']=0;
                                    }  
                                    $testid= $_GET['test'];
                                    $totalv = $method->query("select count(*) as total from question where test_id='$testid'");
                                    $total = $totalv->fetch_assoc();
                                ?>
                                <p class="category pull-right"> Question <?php echo $_SESSION['count']+1;?> of <?php echo $total['total'];?></p>
                                <div class="clearfix"></div>
                            </div>
                             <div class="content">
                                <form method="post" action="process.php">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                     $limit = $_SESSION['count'].",1";
                                                     $questionQ = $method->query("select question_id,question_text from question where test_id='$testid' limit ".$limit);
                                                     while($q = $questionQ->fetch_assoc())
                                                     {
                                                            $question[] = $q;
                                                     }
                                                    //  echo json_encode($question);
                                                ?>
                                                <p class="question"><?php echo $question[0]['question_text'];?></p>
                                                <input type="hidden" name="question-number" value="<?php echo $question[0]['question_id'];?>"/>
                                                <input type="hidden" name="test-id" value="<?php echo $testid;?>"/>
                                                <ul class="choices">
                                                    <?php 
                                                        $question_id= $question[0]['question_id'];
                                                        $choicesQ = $method->query("select * from choices where question_id='$question_id'");
                                                        while($choice = $choicesQ ->fetch_assoc())
                                                        {?>
                                                        <li class="text-left">
                                                         <input  name="choice" type="radio" value="<?php echo $choice['choice_id'];?>"/>
                                                         <?php echo $choice['choice_text'];?>
                                                        </li>
                                                      <?php  }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" name="next-question">Next Question</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            
                            
                        </div>
                    </div>

                </div>
               </div>
               </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
