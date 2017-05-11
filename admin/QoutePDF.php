<?php
 include '../core/Libaries/fpdf.php';
 $pdf = new FPDF();
 
 $pdf->AddPage();
 $pdf->SetFont("Arial","B",20);
 $pdf->Cell($pdf->GetPageWidth()/2,10,"Ipheya IT Solution",0,1,'L');
 $pdf->Cell($pdf->GetPageWidth()/2,10,"Ipheya IT Solution",0,1,'R');
 $pdf->SetFont("Arial","",13);
 $pdf->Cell(0,10,"Nhlakanipho's First PDF",0,2);
=======

 $pdf->AddPage();
 $pdf->SetFont("Arial","B",30);
 $pdf->Cell(0,10,"Nhlakanipho's First PDF",1);

>>>>>>> 12fb090b17c7b0bdab79e4fb96168bc51cc545cb
 $pdf->Output();
?>