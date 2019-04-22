<?php
session_start();

include_once("../fpdf/fpdf.php");

if ($_GET["order_date"] && $_GET["invoice_no"]) {
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->setFont("Arial","B",16);
	$pdf->Cell(190,12,"Inventory System by Rahil Mukund Rohit and Mohit","LRT",1,"C");
	$pdf->setFont("Arial","B",12);
	$pdf->Cell(190,5,"SPIT warehouse services","LR",1,"L");
	$pdf->setFont("Arial",null,12);
	$pdf->Cell(190,5,"Munshi Nagar, Andheri West","LR",1,"L");
	$pdf->Cell(190,5,"Contact No.: 7506543219","LR",1,"L");
	$pdf->Cell(190,5,"Email ID: rsheth972@gmail.com","LRB",1,"L");


	$pdf->Cell(50,10,"",0,1);
	$pdf->Cell(50,10,"",0,1);

	$pdf->setFont("Arial","B",12);
	$pdf->Cell(50,10,"Date",0,0);
	$pdf->setFont("Arial",null,12);
	$pdf->Cell(50,10,": ".$_GET["order_date"],0,1);
	$pdf->setFont("Arial","B",12);
	$pdf->Cell(50,10,"Customer Name            : ",0,0);
	$pdf->setFont("Arial",null,12);
	$pdf->Cell(130,10,"".$_GET["cust_name"],"B",1);

	$pdf->Cell(50,10,"",0,1);


	$pdf->setFont("Arial","B",12);
	$pdf->Cell(10,8,"#",1,0,"C");
	$pdf->Cell(70,8,"Product Name",1,0,"C");
	$pdf->Cell(30,8,"Quantity",1,0,"C");
	$pdf->Cell(40,8,"Price",1,0,"C");
	$pdf->Cell(40,8,"Total (Rs)",1,1,"C");

	$pdf->setFont("Arial",null,12);
	for ($i=0; $i < count($_GET["pid"]) ; $i++) { 
		$pdf->Cell(10,10, ($i+1) ,1,0,"C");
		$pdf->Cell(70,10, $_GET["pro_name"][$i],1,0,"C");
		$pdf->Cell(30,10, $_GET["qty"][$i],1,0,"C");
		$pdf->Cell(40,10, $_GET["price"][$i],1,0,"C");
		$pdf->Cell(40,10, ($_GET["qty"][$i] * $_GET["price"][$i]) ,1,1,"C");
	}

	$pdf->Cell(50,6,"",0,1);
$pdf->setFont("Arial","B",12);
	$pdf->Cell(50,6,"Sub Total",0,0);
	$pdf->Cell(50,6,": ".$_GET["sub_total"],0,1);
	$pdf->Cell(50,6,"Gst Tax",0,0);
	$pdf->Cell(50,6,": ".$_GET["gst"],0,1);
	$pdf->Cell(50,6,"Discount",0,0);
	$pdf->Cell(50,6,": ".$_GET["discount"],0,1);
	$pdf->Cell(50,6,"Net Total",0,0);
	$pdf->Cell(50,6,": ".$_GET["net_total"],0,1);
	$pdf->Cell(50,6,"Paid",0,0);
	$pdf->Cell(50,6,": ".$_GET["paid"],0,1);
	$pdf->Cell(50,6,"Due Amount",0,0);
	$pdf->Cell(50,6,": ".$_GET["due"],0,1);
	$pdf->Cell(50,6,"Payment Type",0,0);
	$pdf->Cell(50,6,": ".$_GET["payment_type"],0,1);

	$pdf->Cell(50,30,"",0,1);
	$pdf->Cell(80,10,"Signature",0,1,"C");
	$pdf->Cell(80,10,"","B",1,"L");
	$pdf->Output("../PDF_INVOICE/PDF_INVOICE_".$_GET["invoice_no"].".pdf","F");

	$pdf->Output();	

}


?>