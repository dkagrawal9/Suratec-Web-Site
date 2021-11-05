<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 23/8/2561
 * Time: 15:21
 */



namespace Card;

include('tcpdf/tcpdf.php');

use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use TCPDF;


class Create
{
    public $id;
    public $image;
    public $name;
    public $cardId;
    public $positon;

    public $companyName;

    public $date;





    /**
     * Create constructor.
     * @param $id string
     * @param $image string
     * @param $name string
     * @param $cardId string
     * @param $positon string
     */
    public function __construct($id = null, $image = null, $name = null, $cardId = null, $positon = null)
    {
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->cardId = $cardId;
        $this->positon = $positon;

        $this->date = new \DateTime();
        $this->date->add(new \DateInterval('P543Y'));
    }

    public function QRGen($cardId = null){
        $qrCode = new QrCode();
        $qrCode
            ->setText($cardId == null ? $this->cardId:$cardId)
            ->setSize(150)
            ->setPadding(1)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 237, 'g' => 255, 'b' => 254, 'a' => 0))
            ->setImageType(QrCode::IMAGE_TYPE_PNG);



        //echo '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate() .'" />';
        return $qrCode->generate();

    }

    public function base64_to_jpeg($base64_string, $output_file , $rotate = false) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $base64_string) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }



    public function BarCodeGen(){
        $barcode = new BarcodeGenerator();
        $barcode->setText($this->cardId);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(9);
        $code = $barcode->generate();

        return $code;

    }

    public function Single(){
        //create pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array('72','48'), true, 'UTF-8', false);

        $pdf->SetMargins(0, 0, 0);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);

        //set head
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetFont('AngsanaUPC' , 'B','12');

        $bgcolor = array(237, 255, 254);


        $this->CreatePage($pdf,$this,$bgcolor)
            ->Output('employee_card_'.$this->id.'.pdf','I');

        //$pdf->Output('example_004.pdf', 'I');
    }

    public function All(array $args){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array('72','48'), true, 'UTF-8', false);

        foreach ($args as $arg){
            $pdf->SetMargins(0, 0, 0);
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, 0);

            //set head
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetFont('AngsanaUPC' , 'B','15');

            $bgcolor = array(237, 255, 254);

            $this->CreatePage($pdf,$arg,$bgcolor);
        }
        $pdf->Output('employee_card_all.pdf','I');

    }

    /**
     * @param $pdf TCPDF
     * @param $data Create
     * @param $bgcolor array
     * @return TCPDF
     */
    private function CreatePage(&$pdf,$data,$bgcolor = array(237, 255, 254)){
        $pdf->AddPage();


        $border_style = array('all' => array('width' => 1, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
        $pdf->Rect(0,0,48,72,'DF','',$bgcolor );

        //$pdf->Image('logo.png', '1', '1', 52, 52, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

        $pdf->SetFont('AngsanaUPC' , 'B','15');
        $pdf->SetXY(0,1);
        $pdf->Cell(0,10, 'บัตรพนักงาน', 0 , 0,'C',0,'',0);
        $pdf->Ln(5);
        $pdf->SetFont('THSarabun' , 'B','14');
        $pdf->Cell(0,10, 'ฟ้าใหม่ยศพันธ์', 0 , 0,'C',0,'',1);

        //Logo

        $pdf->Image($data->image, '14', '15', 22, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        $pdf->SetFont('THSarabun' , 'B','11');
        $pdf->SetXY(7,45);
        $pdf->Cell(13,0, 'Card No. :', 0 , 0,'R',0,'',0);
        $pdf->SetXY(19,45);
        $pdf->Cell(20,0, $data->cardId, 0 , 0,'L',0,'',0);

        $pdf->SetXY(7,49);
        $pdf->Cell(13,0, 'ชื่อ :', 0 , 0,'R',0,'',0);
        $pdf->SetXY(19,49);
        $pdf->Cell(20,0, $data->name, 0 , 0,'L',0,'',0);

        $pdf->SetXY(7,53);
        $pdf->Cell(13,0, 'ตำแหน่ง :', 0 , 0,'R',0,'',0);
        $pdf->SetXY(19,53);
        $pdf->Cell(20,0, $data->positon, 0 , 0,'L',0,'',0);

        $pdf->SetXY(7,57);
        $pdf->Cell(13,0, 'วันที่ออกบัตร :', 0 , 0,'R',0,'',0);
        $pdf->SetXY(19,57);
        $pdf->Cell(20,0, $data->date->format('d/m/Y'), 0 , 0,'L',0,'',0);


        // define barcode style
        $style = array(
            'position' => array(0,0),
            'align' => 'C',
            'stretch' => true,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => '0.2',
            'vpadding' => '0.2',
            'fgcolor' => array(0,0,0),
            'bgcolor' => $bgcolor ,
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 4,
            'stretchtext' => 4
        );

        //$pdf->SetXY(18,63);
        //$pdf->StartTransform();
        //$pdf->Rotate(270);
        //$pdf->Image($path['barcode'], '5', '15', 8, 30, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        //$pdf->write1DBarcode($create->cardId, 'UPCA', '-32', '70', 40, 8, 0.2, $style, 'N');
        $pdf->write1DBarcode($data->cardId, 'UPCA', '1.7', '63', 50, 8, 0.47, $style, 'N');
        //$pdf->StopTransform();

        $pdf->SetXY(0,0);
        $pdf->Image('@'.base64_decode($data->QRGen()), '2.0', '34', 11, 11, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

        return $pdf;
    }



}