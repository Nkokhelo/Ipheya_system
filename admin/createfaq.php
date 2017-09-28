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
              <div class="col-xs-11 b">
               <h3 class="text-center">Create a FAQ</h3><hr class="bhr"/>
               <form  method="post" action="createfaq.php">
                <div class="row">
                <input type="hidden" name="faq_id" value="<?= $FAQ['f_id']?>">
                <div class="col-xs-12">
                  <?=$feedback?>
                </div>
                <div class="col-xs-6">
                 <label for="question">Department:</label>
                 <select class="form-control" name="d_id">
                  <option>--Select--</option>
                  <?=$alldepartment?>
                 </select>
                </div>
               </div>
               <div class="row">
                <div class="col-xs-6">
                <label for="question">Cateory : </label>
                <select class="form-control" name="cat">
                 <option>--Select--</option>
                 <option value="accounts">Account</option>
                 <option value="services">Services</option>
                 <option value="maintanance">Maintanances</option>
                 <option value="repairs">Repairs</option>
                </select>
                </div>
               </div>
               <div class="row">
                <div class="col-xs-6">
                 <label for="question">Question : </label>
                 <textarea type="textarea" name="question" id="quetion" class="form-control"><?=$FAQ['question']?></textarea>
                </div>
                <div class="col-xs-6">
                 <label for="question">Answer : </label>
                 <textarea type="textarea" name="answer" id="quetion" class="form-control"></textarea>
                </div>
               </div>
               <div class="row">
                <hr class="bhr"/>
                 <div class="col-xs-4 col-xs-offset-4">
                  <input type="submit" name="save" value="save" class="btn btn-block btn-default">
                 </div>
               </div>
                </form>
               </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

