<?php 
    require_once '../admin/library/connect.php';
    require_once 'vendor/autoload.php';
	
	$datedafult = date("Y-m-d H:i:s");
const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
const BAHT_TEXT_TWENTY = 'ยี่';
const BAHT_TEXT_INTEGER = 'ถ้วน';
const BAHT_TEXT_BAHT = 'บาท';
const BAHT_TEXT_SATANG = 'สตางค์';
const BAHT_TEXT_POINT = 'จุด';	

function DateThai($strDate) 
    {

        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    function baht_text ($number, $include_unit = true, $display_zero = true)
{
    if (!is_numeric($number)) {
        return null;
    }
    $log = floor(log($number, 10));
    if ($log > 5) {
        $millions = floor($log / 6);
        $million_value = pow(1000000, $millions);
        $normalised_million = floor($number / $million_value);
        $rest = $number - ($normalised_million * $million_value);
        $millions_text = '';
        for ($i = 0; $i < $millions; $i++) {
            $millions_text .= BAHT_TEXT_UNITS[6];
        }
        return baht_text($normalised_million, false) . $millions_text . baht_text($rest, true, false);
    }
    $number_str = (string)floor($number);
    $text = '';
    $unit = 0;
    if ($display_zero && $number_str == '0') {
        $text = BAHT_TEXT_NUMBERS[0];
    } else for ($i = strlen($number_str) - 1; $i > -1; $i--) {
        $current_number = (int)$number_str[$i];
        $unit_text = '';
        if ($unit == 0 && $i > 0) {
            $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
            if ($current_number == 1 && $previous_number > 0) {
                $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
            } else if ($current_number > 0) {
                $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
            }
        } else if ($unit == 1 && $current_number == 2) {
            $unit_text .= BAHT_TEXT_TWENTY;
        } else if ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
            $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
        }
        if ($current_number > 0) {
            $unit_text .= BAHT_TEXT_UNITS[$unit];
        }
        $text = $unit_text . $text;
        $unit++;
    }
    if ($include_unit) {
        $text .= BAHT_TEXT_BAHT;
        $satang = explode('.', number_format($number, 2, '.', ''))[1];
        $text .= $satang == 0
            ? BAHT_TEXT_INTEGER
            : baht_text($satang, false) . BAHT_TEXT_SATANG;
    } else {
        $exploded = explode('.', $number);
        if (isset($exploded[1])) {
            $text .= BAHT_TEXT_POINT;
            $decimal = (string)$exploded[1];
            for ($i = 0; $i < strlen($decimal); $i++) {
                $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
            }
        }
    }
    return $text;
}

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$tagsHTML = '';
    $sql = "SELECT `setting`,`value` FROM `contact` WHERE `setting`='   email' OR `setting` = 'name_company'  OR `setting` = 'pic_logo' OR `setting` = 'address' OR `setting` = 'mobile' OR `setting` = 'email_contract' ORDER BY `id` ASC ";
    $query = mysqli_query($objConnect, $sql);
    $values_arr = array();
    while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        array_push($values_arr, [$result['setting'] => $result['value']]);
    }

    $sql = "SELECT *,mod_order.status as status_dl ,mod_shipping.name_shipping AS name_shipping , mod_shipping.price AS price_shipping FROM mod_order  
 LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
 LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
 LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
 LEFT JOIN mod_shipping ON mod_shipping.id_shipping = mod_order.id_shipping

LEFT JOIN product ON product.id_product = mod_order_item.id_product
LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product


 WHERE mod_order.id_order = '".$_GET['id']."' ";

    $query = mysqli_query($objConnect, $sql);
$tagsHTML .=  $sql;
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
	$date_pay = $result['order_datetime'];	
        $tagsHTML .=  '
        <!DOCTYPE html>
        <html>
        <head>
        <style>
            .style-center {
                font-family: Garuda;
                text-align: center;
                line-height: 5px;
            }

            .style-thai {
                font-family: Garuda;
            }

            .style-head-table {
                border-collapse: collapse;
                margin-top: 25px;
            }

            .style-body-table {
                /*border: 1px solid black;*/
                padding: 10px;
            }

            .style-head-license {
                font-family: Garuda;
                text-align: right;
                margin-top: 75px;
                margin-right: 0px;
            }

            .style-body-license {
                font-family: Garuda;
                text-align: right;
                margin-top: 50px;
                margin-right: 0px;
            }
            
            .style-footer-license {
                font-family: Garuda;
                text-align: right;
                margin-right: 0px;
            }
			 .style-topp_table {
                font-family: Garuda;
                margin-top: 90px;
            }

        </style>
        </head>
        <body>

			<table class="style-thai" style="width: 100%;">
                <tr>
                    <td style="width: 10%;"><center><img src="../uploads/mod_central_information/' . $values_arr[1]['pic_logo'] . '" width="110" height="50"></center></td>
                    <td style="width: 75%;">
						<h3>' . $values_arr[0]['name_company'] . '</h3>
						<p style="margin-top: 25px;">ที่อยู่  : ' . $values_arr[2]['address'] . ' </p>
						<p style="margin-top: 25px;">โทร​. ' . $values_arr[3]['mobile'] . '   </p>
                        <p style="margin-top: 25px;">E-mail. ' . $values_arr[4]['email_contract'] . '   </p>
						<p>&nbsp;<br></p>
					</td>
					<td style="width: 15%;">
						<span style="background-color: #E09B38;"><strong>สำหรับลูกค้า</strong><br><br><br><br><br><br><br></span>
					</td>	
                </tr>
            </table>
              
            <p class="style-center"> </p>
            <h2 class="style-center" style="margin-top: 25px;">สำเนาใบกำกับภาษี</h2>
			<h4 class="style-center" style="margin-top: 5px;">COPY TAX INVOICE</h4>
			<br>
            <table class="style-thai" style="width: 100%;">
                <tr>
                    <td style="width: 70%;"><strong>นามลูกค้า : </strong> ' . $result['fname'] . ' '.$result['lname'].'</td>
                    <td style="width: 30%;"><strong>เลขที่ : </strong>' . $_GET['id'] . '</td>
                </tr>
                <tr>
                    <td style="width: 70%;"><strong>ที่อยู่ : </strong> ' . $result['address'].' '.'ต.'.$result['district'].' '.'อ.'. $result['amphur'].' '.'จ.'. $result['province'].' '.$result['postalcode']   . '</td>
                    <td style="width: 30%;"><strong>วันที่  : </strong>' . DateThai($date_pay) . '</td>
                </tr>
				<tr>
                    <td style="width: 70%;"></td>
                  <td style="width: 30%;"></td>
                </tr>
            </table>';
$tagsHTML .= '     
<table width="793" border="0" cellspacing="0" cellpadding="0" style="margin-top: 20px;" class="style-thai">
  <tbody>
    <tr>
      <td colspan="2"><table width="793" border="1" cellspacing="0" cellpadding="0">
        <tbody>
          <tr style="background-color: #a7a7a7">
		  	<td width="45" style="text-align: center; color: #FFFFFF">ลำดับ</td>
            <td width="460" style="color: #FFFFFF" >&nbsp;รายการ</td>
            <td width="68" style="text-align: center; color: #FFFFFF">จำนวน</td>
            <td width="90" style="text-align: center; color: #FFFFFF">ราคา/หน่วย</td>
			<td width="130" style="text-align: center; color: #FFFFFF">รวมเงิน</td>   
          </tr>';
          $i=0;
          $subtotal = 0;
           $sql1 = "SELECT *,mod_order.status as status_dl ,mod_shipping.name_shipping AS name_shipping , mod_shipping.price AS price_shipping FROM mod_order  
 LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
 LEFT JOIN mod_shipping ON mod_shipping.id_shipping = mod_order.id_shipping

LEFT JOIN product ON product.id_product = mod_order_item.id_product
LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product


 WHERE mod_order.id_order = '".$_GET['id']."' ";

    $query1 = mysqli_query($objConnect, $sql1);
           while($result1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)){
            $i++;
$tagsHTML .= '              
          <tr>
            <td style="text-align: right">'.$i.'&nbsp;</td>
            <td>&nbsp; ' .$result1['name_product'].'( '.$result1['option_name']. ' ) </td>
            <td style="text-align: right">' . number_format($result1['qty']) . '&nbsp;</td>
            <td style="text-align: right">' . number_format($result1['price'],2,".",",") . ' บาท</td>
			<td style="text-align: right">' . number_format($result1['subtotal'],2,".",",") . ' บาท</td>  
          </tr>';
          $subtotal += $result1['subtotal'];
      }
$tagsHTML .= '      
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td width="573" style="style-topp_table">
<table width="573" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="border: 1px solid #FFFFFF;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border: 1px solid #FFFFFF;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border: 1px solid #FFFFFF;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border: 1px solid #FFFFFF;">&nbsp;</td>
    </tr>
	<tr>
      <td style="border: 1px solid #FFFFFF;">ตัวอักษร.(' . baht_text($subtotal).')</td>
    </tr>
  </tbody>
</table>
	  </td>
      <td width="220" align="right" valign="baseline">
	  <table width="220" border="1" cellspacing="0" cellpadding="0">
	  	<tbody>
          <tr>
            <td width="90">รวมเงิน</td>
            <td width="130">' . number_format($subtotal,2,".",",") . ' บาท</td>
          </tr>
          <tr>
            <td>ส่วนลด</td>
            <td>0.00 บาท</td>
          </tr>
          
          
          <tr>
            <td>ยอดเงินสุทธิ</td>
            <td>' . number_format($subtotal,2,".",",") . ' บาท</td>
          </tr>
        </tbody>
      </table> 
      </td>
    </tr>
  </tbody>
</table>
           ';
$tagsHTML .= '			
        </body>
        </html>
		';
		

// 	 <p class="style-head-license">ในนาม ' . $values_arr[5]['COMPANY_NAME'] . ' </p>
// <div style="text-align: right; margin-bottom: -30px;" class="style-footer-license">
// <img src="../../uploads/' . getLisinimg() . '/company_lisin/' . getLisin() . '" style="width: 100px; height: 40px;">
// </div>  
//             <p class="style-body-license">' . $values_arr[4]['PAYEE'] . '</p>
//             <p class="style-footer-license"> ' . $values_arr[2]['EXE_POS'] . '</p>		

		
		//call watermark content aand image
		$mpdf->SetWatermarkText('suratec.co.th');
		$mpdf->showWatermarkText = true;
		$mpdf->watermarkTextAlpha = 0.1;
        
        $mpdf->AddPage();
		$mpdf->WriteHTML($tagsHTML);
		// $mpdf->AddPage();
  //       $mpdf->WriteHTML($tagsHTML1);
        
    


    
    $mpdf->Output("Onlinethenews_report_$start_date - $end_date".".pdf",'i');
?>