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
 $pdf->Cell(30,5,"Call: 0318240515/0832774984",0,1);

 #the Qoutation Sumarry
 $pdf->SetXY(120,40);
 $pdf->SetFont("Arial","B",12);
 $pdf->Cell(30,5,"Qoute summary");
 $pdf->SetFont("Arial","",12);
 $pdf->SetXY(120,46);
 $pdf->MultiCell(80,5, "This is bla bla bla and also the blarest thing I've ever seen",0,"L");
 $pdf->Line(11,61,198,61);
 $pdf->Ln();
 $pdf->SetFont("Arial","B",13);
 $pdf->SetY(63);
 $pdf->Cell(180,5,"Items for this qoutation",0,0,'C');
  $pdf->SetXY(10,68);
 $pdf->Cell(50,5,"Name",1,0,'C');
 $pdf->Cell(30,5,"Quantity",1,0,'C');
 $pdf->Cell(50,5,"Unit Price",1,0,'C');
 $pdf->Cell(50,5,"Total Item Price",1,0,'C');
 $pdf->SetFont("Arial","",13);

 for($x=0;$x<10; $x++)
 {
     $pdf->Ln();
    $pdf->setX(10);
    $pdf->Cell(50,5,"Name".$x,1,0,'L');
    $pdf->Cell(30,5,"Quantity".$x,1,0,'L');
    $pdf->Cell(50,5,"Unit Price".$x,1,0,'L');
    $pdf->Cell(50,5,"Total Item Price".$x,1,0,'L');
 }
 $pdf->Ln();
 $pdf->SetX(90);
 $pdf->Cell(50,5,"Total Price");
 $pdf->Cell(50,5,"600",1,0,'L');

 $pdf->Line(11,130,190,130);

 $pdf->Line(11,180,190,180);
 $pdf->Output();
?>