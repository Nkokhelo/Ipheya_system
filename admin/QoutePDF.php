<?php
 include '../core/Libaries/fpdf.php';
 $pdf = new FPDF();
 
 $pdf->AddPage();
 $pdf->SetFont("Arial","B",20);
 $pdf->Cell($pdf->GetPageWidth()/2,10,"Ipheya IT Solution",0,1,'L');
 $pdf->Cell($pdf->GetPageWidth()/2,10,"Ipheya IT Solution",0,1,'R');
 $pdf->SetFont("Arial","",13);
 $pdf->Cell(0,10,"Nhlakanipho's First PDF",0,2);
 $pdf->Output();
?>