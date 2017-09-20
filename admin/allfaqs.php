<?php
  include 'includes/head2.php';
  include('../core/init.php');
  include('../core/logic.php');
  include('../core/controllers/faq-controller.php');
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>

      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>

              <div class="col-xs-6">
                <ol class="breadcrumb">
                  <li><a href="dashboard.php">Home</a></li>
                  <li class="active">FAQ's</li>
                </ol>
              </div><!-- /col-xs-6-->



              <div class="col-xs-11 b">
               <h2>Manage FAQ's</h2><hr class="bhr"/>
               <?=$feedback?>

                 <table class="table">
                  <thead>
                   <?php if(isset($_GET['u'])){?>
                    <tr><th>Question</th><th>Name</th><th>Email</th></tr>
                     <?php }
                     elseif(isset($_GET['an'])){
                     ?>
                    <tr><th>Question</th><th>Department</th></tr>
                    <?php }  else{ ?>
                      <tr><th>Question</th><th>Answered</th></tr>
                   <?php }?>
                  </thead>
                  <tbody>
                   <?=$faqs?>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table><!--/table-->
                <hr class="bhr"/>
                <div class="col-xs-12">
                  <div class="col-xs-8 col-xs-offset-2">
                    <div class="btn-group btn-group-justified">
                      <a class="btn btn-default" href="allfaqs.php">List all Questions</a>
                      <a class="btn btn-default" href="allfaqs.php?u=faqs">Unanswered Questions</a>
                      <a class="btn btn-default" href="allfaqs.php?an=faqs">Answered Questions</a>
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
