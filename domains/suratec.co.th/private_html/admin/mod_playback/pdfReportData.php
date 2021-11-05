<?php

require('WriteHTML.php');

$pdf=new PDF_HTML();
$pdf->AliasNbPages();

//add page automatically for its true parameter

$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

//add logo image here

$pdf->Image('../../assets/fpdf/logo.jpeg',18,13,33);

//set font style

$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<para><h1>Codefixup.com - API and Web development Tutorial Website</h1><br>
Website: <u>www.codefixup.com</u></para><br><br>How to Convert HTML to PDF with fpdf example');

//set the form of pdf

$pdf->SetFont('Arial','B',8);

//assign the form post value in a variable and pass it. 

$htmlTable='<TABLE>
<TR>
<TD>Name:</TD>
<TD>Rajesh</TD>
</TR>
<TR>
<TD>Email:</TD>
<TD>Rajesh</TD>
</TR>
<TR>
<TD>Phone:</TD>
<TD>Rajesh</TD>
</TR>
</TABLE>';

//Write HTML to pdf file and output that file on the web browser.

// print_r($pdf);
// die;
$pdf->WriteHTML("<br><br>$htmlTable");
$pdf->SetFont('Arial','B',6);

$pdf->Output(); 

?>