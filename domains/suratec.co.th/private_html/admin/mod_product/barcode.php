<?php
  require_once '../library/connect.php';
  require_once '../library/functions.php';

//============================================================+
// File name   : example_050.php
// Begin       : 2009-04-09
// Last Update : 2013-05-14
//
// Description : Example 050 for TCPDF class
//               2D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 2D barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('card/tcpdf/tcpdf.php');

// create new PDF document
$custom_layout = array(96, 40);
$pdf = new TCPDF('L', 'mm', $custom_layout, true, 'UTF-8', false);

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);



// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// set font
$pdf->SetFont('helvetica', '', 6);

// add a page
$pdf->AddPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// set style for barcode
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

$margin_left = array('7','39','70');




    $i=0;
    $a=1;
    $str = "SELECT * FROM product_attribute WHERE barcode = '".$_GET['id']."'";
    $query = mysqli_query($objConnect,$str);
    $num_row = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);
        // QRCODE,L : QR-CODE Low error correction
    for($j=1;$j<=$_GET['num'];$j++){
        $barcode = (string)$result['barcode'];
        // $barcode = '1234567';
        // EAN 8
        if($i==3){
            $i=0;
            $pdf->AddPage();
        }

        $pdf->write1DBarcode($result['barcode'], 'EAN8', $margin_left[$i],'2', '50',15, 0.3, $style, 'N');
        // $pdf->write2DBarcode($result['barcode'], 'QRCODE,L', $margin_left[$i], 1, 0, 0, $style, 'N');

        $i++;
        $a++;   
    }



// // QRCODE,L : QR-CODE Low error correction
// $pdf->write2DBarcode('55557777', 'QRCODE,L', 39, 1, 20, 20, $style, 'N');
// // 

// // QRCODE,L : QR-CODE Low error correction
// $pdf->write2DBarcode('55557777', 'QRCODE,L', 70, 1, 20, 20, $style, 'N');
// // $pdf->Text(20, 25, 'QRCODE L');


// -------------------------------------------------------------------
// PDF417 (ISO/IEC 15438:2006)

/*

 The $type parameter can be simple 'PDF417' or 'PDF417' followed by a
 number of comma-separated options:

 'PDF417,a,e,t,s,f,o0,o1,o2,o3,o4,o5,o6'

 Possible options are:

     a  = aspect ratio (width/height);
     e  = error correction level (0-8);

     Macro Control Block options:

     t  = total number of macro segments;
     s  = macro segment index (0-99998);
     f  = file ID;
     o0 = File Name (text);
     o1 = Segment Count (numeric);
     o2 = Time Stamp (numeric);
     o3 = Sender (text);
     o4 = Addressee (text);
     o5 = File Size (numeric);
     o6 = Checksum (numeric).

 Parameters t, s and f are required for a Macro Control Block, all other parametrs are optional.
 To use a comma character ',' on text options, replace it with the character 255: "\xff".

*/



// -------------------------------------------------------------------


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_050.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+