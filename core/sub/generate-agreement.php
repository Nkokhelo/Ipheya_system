<?php
#20427839 Xulu K
#21539288 POLELA AL
require_once('../core/init.php');
#require_once('../init.php');
$id = mysqli_real_escape_string($db,$_GET['agrid']);
$sql = mysqli_query($db, "SELECT * FROM supplier_agreement WHERE supplier_no = '$id'");
$res = mysqli_fetch_assoc($sql);
$suppname = mysqli_query($db, "SELECT company_name FROM suppliers WHERE supplier_no = '$id' ");
$nameres = mysqli_fetch_assoc($suppname);
$warranty = explode(':',$res['warranty']);

if($res['delivery_fee']=='N/A')
{
  $state = 'NO';
  $dfee = $res['delivery_fee'];
}
else{
  $state = 'YES';
  $dfee = 'R'.$res['delivery_fee'].'.00';
}
$html = '<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../assets/Site.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <title>Supplier Agreement</title>
  </head>
  <body>
    <div class="container-fluid">
     <div class="col-md-12 text-center"><img style="margin-top:-5%;margin-bottom:1%;" src="../assets/images/logo.gif" width="100" height="125"></div>
     <div class="col-md-12 text-center">
         <h3 class="title">Ipheya Supplier agreement</h3><br>
         <p><strong><span>Phone:<i>(031) 554 2639</i></span>  <span>Fax:<i>(031) 554 2620</i></span>  <span><i>info@ipheya.com</i></span></strong></p>
     </div>
     <div class="col-md-12 text-center"
         <p>This contract is between '.$nameres['company_name'].' and Ipheya IT Solutions. This contract is valid until '.$res['end_date'].' provided that no company revokes this
         contract in written form.
         </p>
         <table class="table">
           <thead>
             <th colspan="2">Terms of agreement</th>
           </thead>
           <tbody>
              <tr>
                 <td><strong>Deposit<strong></td>
                 <td>'.$res['deposit'].' %</td>
              </tr>
              <tr>
                 <td><strong>Delivery<strong></td>
                 <td>'.$state.'</td>
              </tr>
              <tr>
                 <td><strong>Delivery Fee<strong></td>
                 <td>'.$dfee.'</td>
              </tr>
              <tr>
                 <td><strong>Discount<strong></td>
                 <td>'.$res['discount'].' %</td>
              </tr>
              <tr>
                 <td><strong>Warranty<strong></td>
                 <td>'.$warranty[0].' '.$warranty[1].'</td>
              </tr>
              <tr>
                 <td><strong>Contract duration<strong></td>
                 <td>'.$res['start_date'].' '.$res['end_date'].'</td>
              </tr>
           </tbody>
         </table>

         <p>'.$res['liability_clause'].'</p>

         <table class="table">
            <tbody>
              <tr>
                <td><strong>Signature:</strong></td> <td style="border-bottom:1px solid #000;"></td> <td><strong>Date:</strong></td> <td style="border-bottom:1px solid #000;"></td>
              </tr>
            </tbody>
         </table>
     </div>
    </div>
  </body>
</html>';
 ?>
