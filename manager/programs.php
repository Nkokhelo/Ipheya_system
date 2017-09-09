<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/programs-controller.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <!-- service form -->
            <div class="col-sm-10 col-sm-offset-2 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
                <h2>project per Client</h2>
                <hr class="bhr">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Program Number</th>
                        <th>Program Name</th>
                        <th>Number of Project(s)</th>
                        <th>...</th>
                    </thead>
                    <tbody>
                        <?=$prog_list?>
                    </tbody>
                    <tfoot>
                        <?= (isset($feedback))?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":' ' ?>
                    </tfoot>
                </table>
                <hr class="bhr"/>
                <div class="col-xs-12">
                    <div class="col-xs-6 col-xs-offset-2">
                        <a data-toggle="modal" data-target="#addprogram" onclick='saveprogram()'class="btn btn-block btn-success"><span class="ion-android-add"></span> New Program</a>
                        <br/>
                    </div>
                </div>
                <?php include('includes/program-modal.php'); ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
     function editprogram(id){
          $('#edit').show();
          $('#save').hide();
          $('#delete').hide();
          $('.cl').hide();
          var title = document.getElementById('title');
          var desc = document.getElementById('description');
          title.removeAttribute('disabled');
          desc.removeAttribute('disabled');
        $.ajax({
            type : "get",
<<<<<<< HEAD
             url : "/ipheya/manager/includes/getjs.php",
=======
             url : "http://www.invest4living.com/Ipheya/manager/includes/getjs.php",
>>>>>>> f8ff3efd7eb1d626d0f9cdb6bc83d285961c9084
            data : "id="+id,
            success:function(data)
            {
                data =JSON.parse(data);
                $('#id').val(data.id);
                $('#title').val(data.program_name);
                $('#description').val(data.description);
                $('#label').text('Edit '+data.program_name+' program');
                // getClient(data.client_no);
                getClient(data.client_no);
                
            },error:function (err) 
            {
                console.log("Result"+err);
            }});
             
    }
     function deleteprogram(id){
          $('#delete').show();
          $('#save').hide();
          $('#edit').hide();
          $('.cl').hide();
         var title = document.getElementById('title');
         var desc = document.getElementById('description');
          title.setAttribute('disabled','true');
          desc.setAttribute('disabled','true');
        $.ajax({
            type : "get",
<<<<<<< HEAD
             url : "/Ipheya/manager/includes/getjs.php",
=======
             url : "http://www.invest4living.com/Ipheya/manager/includes/getjs.php",
>>>>>>> f8ff3efd7eb1d626d0f9cdb6bc83d285961c9084
            data : "id="+id,
            success:function(data)
            {
                data =JSON.parse(data);
                $('#id').val(data.id);
                $('#title').val(data.program_name);
                $('#description').val(data.description);
                $('#label').text('Archive '+data.program_name+' program?');    
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
          $('#cInfo').hide();
          $('.cl').show();
          var title = document.getElementById('title');
          var desc = document.getElementById('description');
          title.removeAttribute('disabled');
          desc.removeAttribute('disabled');
          $('#title').val(' ');
          $('#description').val(' ');
          $('#label').text('New Program');

    }

    function getClient(client_no)
    {
<<<<<<< HEAD
        $('#cInfo').load('/Ipheya/manager/includes/getjs.php?clientInfor='+client_no);
        // $.ajax({ that was a log methord
        //     type : "get",
        //      url : "/Ipheya/manager/includes/getjs.php",
=======
        $('#cInfo').load('http://www.invest4living.com/Ipheya/manager/includes/getjs.php?clientInfor='+client_no);
        // $.ajax({ that was a log methord
        //     type : "get",
        //      url : "http://www.invest4living.com/Ipheya/manager/includes/getjs.php",
>>>>>>> f8ff3efd7eb1d626d0f9cdb6bc83d285961c9084
        //     data : "clientInfor="+client_no,
        //     success:function(data)
        //     {
        //         data =JSON.parse(data);
        //         document.getElementById("cInfo").innerHTML= "<h3 class='text-left' style='color:#888'>Client Information</h3>"+data;
                
        //     },error:function (err) 
        //     {
        //         console.log("Result"+err);
        //     }});
    }
</script>
<?php include('includes/footer.php'); ?>
