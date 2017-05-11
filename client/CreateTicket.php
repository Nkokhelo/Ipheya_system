<?php
     require_once('../core/init.php');
     include('../admin/includes/head.php');
     include('../admin/includes/navigation.php');
     include('../core/logic.php');
     require_once('../core/controllers/ticket-controller.php');
?>
<body>
<div class="container-fluid">
<form method="POST" action="CreateTicket.php">
  <h2>Request for a ticket</h2>
    <div class="col-md-12">
        <div class="col-md-3">
            Subject:</br>
            <input  type="Text" name="Subject" class="form-control" placeholder="Subject"/> 
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">
             RequestType:</br>
                <select id="Request" class="form-control" name="RequestType">
                    <option value="0">--Select Request Type--</option>
                    <option value="1">Service</option>
                    <option value="2">Maintenance</option>
                    <option value="3">Repairs</option>
                </select>
            </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">
             ProblemDescription:</br>
            <textarea CLASS="foo" class="form-control" name="ProblemDescription"  cols="80" rows="6"></textarea>

        </div>
    </div>
     </br>
 
            </br>
           
            <style>
            textarea.foo
            {
            resize:true;
            }

            </style>
            </br>
            </br>
            <input type="submit" name="Submit" class="btn btn-default" value="Submit"/>  
            <a href='#' class="btn btn-default">Cancel</a>
            
  </form>
     
</div>
        
</body>