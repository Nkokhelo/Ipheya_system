<?php
 include '../core/Libaries/fpdf.php';
 $pdf = new FPDF();

 $pdf->AddPage();
 $pdf->SetFont("Arial","B",30);
 $pdf->Cell(0,10,"Nhlakanipho's First PDF",1);

 $pdf->Output();
?>