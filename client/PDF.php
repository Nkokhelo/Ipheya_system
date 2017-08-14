<?php
// include('CreateTicket.php');
include'../core/Libraries/fpdf.php';

$Subject=$_POST['Subject'];
$RequestType=$_POST['RequestType'];
$ProblemDescription=$_POST['ProblemDescription'];



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"Proof Of Ticket");


$pdf->output();
?>