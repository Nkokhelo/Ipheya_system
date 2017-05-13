<?php
     require_once('core/init.php');
     include('includes/head.php');
     include('core/logic.php');
     require_once('core/controllers/ticket-controller.php');
?>
<body id="client-dashboard">
<?php  include('includes/top-nav.php'); ?>
<div class="container-fluid">
<?php include('includes/sidebar.php'); ?>
   <div class="col-lg-9">
        <form method="POST" action="CreateTicket.php" enctype="multipart/form-data">
  <h2>Request for a ticket</h2>
    <div class="form-group col-md-12">
        <div class="col-md-6">
            Subject:</br>
            <input  type="Text" name="Subject" class="form-control" placeholder="Subject" required> 
        </div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-6">
             RequestType:</br>
                <select id="Request" class="form-control" name="RequestType" required>
                    <option value="0">--Select Request Type--</option>
                    <option value="1">Service</option>
                    <option value="2">Maintenance</option>
                    <option value="3">Repairs</option>
                </select>
            </div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-6">
             ProblemDescription:</br>
            <textarea class="form-control foo" name="ProblemDescription"  cols="80" rows="6" required></textarea>

            <style>
            textarea.foo
            {
            resize:true;
            }
            </style>

              <div>
             <input type="file" name="files[]" multiple="true"/>
             </div> 
             </div>
             </div>

           <div class="form-group col-md-12">
             <input type="submit" name="Submit" class="btn btn-success" value="Submit"/>  
             <a href='home.php' class="btn btn-warning">Cancel</a>
           </div>
            
  </form>
   </div>    
</div>
        
</body>