<?php
  include 'includes/head.php';
  include('../core/init.php');
  include('../core/controllers/faq-controller.php');
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>

      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-10 b">
               <h3 class="text-center">Create a FAQ</h3><hr class="bhr"/>
               <div class="row">
                <div class="col-xs-6">
                 <label for="question">Department : </label>
                 <select class="form-control">
                  <option>--Select--</option>
                  <?=$alldepartmets?>
                 </select>
                </div>
               </div>
               <div class="row">
                <div class="col-xs-6">
                <label for="question">Cateory : </label>
                <select class="form-control">
                 <option>--Select--</option>
                </select>
                </div>
               </div>
               <div class="row">
                <div class="col-xs-6">
                 <label for="question">Question : </label>
                 <textarea type="textarea" name="question" id="quetion" class="form-control"></textarea>
                </div>
                <div class="col-xs-6">
                 <label for="question">Answer : </label>
                 <textarea type="textarea" name="question" id="quetion" class="form-control"></textarea>
                </div>
               </div>
               </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

