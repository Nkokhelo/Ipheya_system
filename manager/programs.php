<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/programs-controller.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<div class="container-fluid" style="margin:1%;">
  <!-- service form -->
  <div class="col-sm-8 col-sm-offset-2 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
    <h2>Programs</h2>
    <hr class="bhr">
    <table class="table table-hover">
        <thead>
            <th>Program Number</th>
            <th>Program Name</th>
            <th>Number of Project(s)</th>
            <th><a data-toggle="modal" data-target="#addprogram" onclick='saveprogram()'class="btn btn-block btn-default"><span class="ion-android-add"></span> New Program</a></th>
        </thead>
        <tbody>
            <?=$prog_list?>
        </tbody>
        <tfoot>
            <?= (isset($feedback))?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":' ' ?>
        </tfoot>
    </table>
        <?php include('includes/program-modal.php'); ?>
  </div>
</div>
<script>
     function editprogram(id){
          $('#edit').show();
          $('#save').hide();
          $('#delete').hide();
          var title = document.getElementById('title');
          var desc = document.getElementById('description');
          title.removeAttribute('disabled');
          desc.removeAttribute('disabled');
        $.ajax({
            type : "get",
             url : "http://localhost:81/Ipheya/manager/includes/getjs.php",
            data : "id="+id,
            success:function(data)
            {
                data =JSON.parse(data);
                $('#id').val(data.id);
                $('#title').val(data.program_name);
                $('#description').val(data.description);
                $('#label').text('Edit '+data.name+' program');

                
            },error:function (err) 
            {
                console.log("Result"+err);
            }});
             
    }
     function deleteprogram(id){
          $('#delete').show();
          $('#save').hide();
          $('#edit').hide();
         var title = document.getElementById('title');
         var desc = document.getElementById('description');
          title.setAttribute('disabled','true');
          desc.setAttribute('disabled','true');
        $.ajax({
            type : "get",
             url : "http://localhost:81/Ipheya/manager/includes/getjs.php",
            data : "id="+id,
            success:function(data)
            {
                data =JSON.parse(data);
                $('#id').val(data.id);
                $('#title').val(data.program_name);
                $('#description').val(data.description);
                $('#label').text('Archive '+data.name+' program?');    
            },error:function (err) 
            {
                console.log("Result"+err);
            }});
    }
    function saveprogram()
    {
          $('#save').show();
          $('#delete').hide();
          $('#edit').hide();
          var title = document.getElementById('title');
          var desc = document.getElementById('description');
          title.removeAttribute('disabled');
          desc.removeAttribute('disabled');
          $('#title').val(' ');
          $('#description').val(' ');
          $('#label').text('New Program');

    }
</script>
<?php include('includes/footer.php'); ?>
