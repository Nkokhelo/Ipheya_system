
<?php
  include 'includes/head2.php';
  include('../core/init.php');
  include('../core/logic.php');
  include('../core/controllers/test-controller.php');
  $logic = new Logic();  
  $method = $logic->connect();
  $connect = $logic->connect();
//   print($_SESSION['score']);
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
                <div class="row">
                    <div class="col-xs-12">
                    <?php
                            $testid = $_GET['test'];                                                        
                            $limit = $_SESSION['count'].",1";
                            $questionQ = $method->query("select question_id,question_text from question where test_id='$testid' limit ".$limit);
                            while($q = $questionQ->fetch_Assoc())
                            {
                                    $question[] = $q;
                            }
                            $testq = $method->query("select * from test where test_id = $testid");
                            $test_name ="";
                            $test = $testq->fetch_Object();
                            $test_name = $test->test_name;
                        ?>
                        <div class="col-xs-10">
                            <h2 class="text-center"><?= $test_name ?> </h2>
                        </div>
                        <div class="col-xs-2"><h2><p id="timmer"></p></h2></div>
                    <hr class="bhr">

                        <div class="col-xs-9">
                        <h4 class="text-left"><?php echo $question[0]['question_text'];?>?</h4>
                        </div>
                        <div class="col-xs-3">
                            <?php
                                $totalv = $method->query("select count(*) as total from question where test_id='$testid'");
                                $total = $totalv->fetch_assoc();
                            ?>
                            <h4 class="category pull-right"> Question <?php echo $_SESSION['count']+1;?> of <?php echo $total['total'];?></h4>
                            <div class="clearfix"></div>
                        </div>
                        <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                           
                                                <input type="hidden" id="q_num" name="question-number" value="<?php echo $question[0]['question_id'];?>"/>
                                                <input type="hidden" name="test-id" value="<?php echo $testid;?>"/>
                                                <ul class="choices">
                                                    <?php 
                                                        $question_id= $question[0]['question_id'];
                                                        $choicesQ = $method->query("select * from choices where question_id='$question_id'");
                                                        while($choice = $choicesQ ->fetch_assoc())
                                                        {?>
                                                        <li class="text-left item">
                                                        <label for="choice" class="contol-label radio">
                                                         <input  name="choice" type="radio" value="<?= $choice['choice_id']?>"/>
                                                        </label>
                                                        <?php echo $choice['choice_text'];?>
                                                        </li>
                                                    <?php  }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="bhr">
                                    <div class="row">
                                        <div class="col-xs-4 col-xs-offset-4">
                                            <button type="submit" class="btn btn-info btn-block pull-right" name="next-question">Next Question</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                    
                    </div>
            </div>
        </div>
    </div>
    </div>
  <?php include('includes/footer.php'); ?>
</body>
<script type="text/javascript">
        var x =59;
        var y =2;

        setInterval(() => {
            x--;
            if(x < 0)
            {
                x=59;
                y--;
            }
            if(y ==0 && x <0)
            {
                var questoin = document.getElementById('q_num');
            }
            $('#timmer').text(y+":"+x);
  }, 1000);
  
</script>