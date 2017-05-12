<?php
 include '../core/Libaries/fpdf.php';
 $pdf = new FPDF();
 $pdf->AddPage();
 $pdf->SetFont("Arial","B",12);
//  $pdf->Cell(60,10,' ',0,2);
 $pdf->SetY(5);
 $pdf->SetFont("Arial","B",30);
 $pdf->Cell(190,10,'Qoute',0,2,'R');
 $pdf->Line(170,16,198,16);

 #logo
 $pdf->SetFont("Arial","B",12);
 $pdf->Image('../assets/index/images/logo.gif',16,6,25);
 $pdf->Ln();
 $pdf->SetY(30);
 $pdf->Cell(30,10,"Ipheya IT Solution",0,2);

 #qoute basic information
 $pdf->SetFont("Arial","",12);
 #set the position of the quotation information
 $pdf->SetXY(168,17);
 $pdf->Cell(30,5,"Qoute Date:2017-20-30",0,2,'R');
 $pdf->Cell(30,5,"Client # :",0,2,'R');
 $pdf->Cell(30,5,"Valid until:",0,2,'R');
 $pdf->Cell(30,5,"Qoute #:",0,2,'R');
#the company basic information
 $pdf->SetXY(10,40);
 $pdf->Line(11,38,198,38);
 $pdf->Cell(30,5,"05 Wallnut Road",0,1);
 $pdf->Cell(30,5,"Smartxchange",0,1);
 $pdf->Cell(30,5,"Durban 4001",0,1);
 $pdf->Cell(30,5,"Office: 0318240515/0832774984",0,1);

 #the Qoutation Sumarry
 $pdf->SetXY(160,40);
 $pdf->Cell(2,5,"05 Wallnut Road \n thgfdsdfgh",0,1);
 
 $pdf->Output();
?>