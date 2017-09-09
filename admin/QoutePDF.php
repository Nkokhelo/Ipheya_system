<?php
 include '../core/Libaries/fpdf.php';
 $pdf = new FPDF();
 $pdf->AddPage('P','A4');
 $pdf->SetFont("Arial","B",12);
//  $pdf->Cell(60,10,' ',0,2);
 $pdf->SetY(5);
 $pdf->SetFont("Arial","B",30);
 $pdf->Cell(190,10,'Qoute',0,2,'R');
 $pdf->Line(170,16,198,16);
# Attribute holder
        session_start();
        $title =$_SESSION['title'];
        $client_no = $_SESSION['client_no'];
        $summary =$_SESSION['Summary'];
        $payment =$_SESSION['PaymentMethord']	;
        $amount =$_SESSION['AmountDue'];
        $expdate =$_SESSION['ExpiringDate']	;
        $qoudate =$_SESSION['QoutationDate'];
        $client_Id =$_SESSION['clientID'];
        $req_Id =$_SESSION['RequestID'];
        $req_Type =$_SESSION['RequestType'];
        $Inames =$_SESSION['names'];
        $Idescri =$_SESSION['descrs'];
        $Iquants =$_SESSION['quants'];
        $Iunits =$_SESSION['units'];
        $IpriceQ =$_SESSION['pricequants'];
        $qoute_no =$_SESSION['qoute_no'];

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
 $pdf->Cell(10,5,"Qoute Date :",0,0,'R');
 $pdf->Cell(30,5,(new DateTime($qoudate))->format("d M Y"),0,0,'L');
     $pdf->Ln();
 $pdf->SetX(168);
 $pdf->Cell(10,5,"Client-No :",0,0,'R');
 $pdf->Cell(30,5,$client_no,0,0,'L');
     $pdf->Ln();
 $pdf->SetX(168);
 $pdf->Cell(10,5,"Qoute-No :",0,0,'R');
 $pdf->Cell(30,5,$qoute_no,0,0,'L');
     $pdf->Ln();
 $pdf->SetX(168);
 $pdf->Cell(10,5,"Qoute Title :",0,0,'R');
 $pdf->Cell(30,5,$title,0,0,'L');
#the company basic information
 $pdf->SetXY(10,40);
 $pdf->Line(11,38,198,38);
 $pdf->Cell(30,5,"05 Wallnut Road",0,1);
 $pdf->Cell(30,5,"Smartxchange",0,1);
 $pdf->Cell(30,5,"Durban 4001",0,1);
 $pdf->Cell(30,5,"Call: 0318240515 / 0832774984",0,1);

#the Qoutation Sumarry
 $pdf->SetXY(120,40);
 $pdf->SetFont("Arial","B",12);
 $pdf->Cell(30,5,"Qoute summary");
 $pdf->SetFont("Arial","",12);
 $pdf->SetXY(120,46);
 $pdf->MultiCell(80,5, "$summary",0,"L");
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
 $nextcell=68+11;
 $last=68+11;
 for($x=0;$x<count($Inames); $x++)
 {
    $pdf->Ln();
    $pdf->setX(10);
    $pdf->Cell(50,5,$Inames[$x],1,0,'L');
    $pdf->Cell(30,5,$Iquants[$x],1,0,'L');
    $pdf->Cell(50,5,$Iunits[$x],1,0,'L');
    $pdf->Cell(50,5,$IpriceQ[$x],1,0,'L');
    $nextcell+=5;
    if($nextcell>274)
    {
        $last=$nextcell;
        $pdf->SetAutoPageBreak(true,30);
        $nextcell=0;
    }
    else
    {
         $last+=5;
    }
 }
 $pdf->Ln();
 $pdf->SetX(90);
 $pdf->Cell(50,5,"Total Price");
 $pdf->Cell(50,5,$amount,1,0,'L');
 $pdf->Line(11,$last,190,$last);
 $pdf->Ln();
 $pdf->setY($nextcell+1);
 $pdf->Cell(100,5,"Quotation prepared by:_________________________________________",0,1);
 $pdf->SetAutoPageBreak(true,30);
 $pdf->SetFont('','BI','');
 $pdf->Cell(80,5,"Terms and Conditions",0,1);
 $pdf->SetFont('','','');
 $pdf->MultiCell(150,7,"*The summary lies here \n*And also here \nThis qoutation is valid until :".(new DateTime($expdate))->format("d M Y")."\nClient is expected to pay $payment% deposit before the job begins.",1,'L');
 $pdf->Ln();
 $pdf->Cell(80,5,"To accept this quotation, sign here and return:______________________",0,1);
 $pdf->Output();
?>