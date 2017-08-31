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
              <div class="col-xs-10 b">
               <h3 class="text-center">Manager Faqs</h3><hr class="bhr"/>
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
                   <tr>
                    <td><a href="allfaqs.php">All Questions</a></td>
                    <td><a href="allfaqs.php?u=faqs">Unanswered questions</a></td>
                    <td><a href="allfaqs.php?an=faqs">Answered Question</a></td>
                   </tr>
                  </tfoot>
                 </table>
               </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

