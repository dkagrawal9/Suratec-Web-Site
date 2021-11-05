<?php

$data = $_GET['data'];
$priceall = $_GET['priceall'];
$qtyproduct = $_GET['qtyproduct'];
$id_customer = $_GET['id_customer'];

require_once '../admin/library/connect.php';


// code
// start_date
// end_date
// used_qty < quantity 


// check =	type
// amount

// condition_type

// condition_min


  $sqlcou = "SELECT * FROM coupon 
             WHERE  coupon.delete_datetime is NULL and	code = '$data' and  Date(start_date) >= CURDATE() AND
             Date(end_date)  >=  CURDATE()  and amount < quantity
             ORDER BY `coupon`.`delete_datetime` DESC "; 
             $objQuerycou = mysqli_query($objConnect,$sqlcou);
             $objResultcou = mysqli_fetch_array($objQuerycou, MYSQLI_ASSOC);
             $amount = $objResultcou['amount'];
             $quantity = $objResultcou['quantity'];
             $coupon_id = $objResultcou['coupon_id'];

          	//  echo $sqlcou;
            
            if(isset($objResultcou)){

                $sqlorder = "SELECT count(coupon_id) as qtycou   FROM `mod_order` 
                where  coupon_id = '$coupon_id' and id_customer =  '$id_customer'         "; 

                $objQueryorder = mysqli_query($objConnect,$sqlorder);
                $objResultorder = mysqli_fetch_array($objQueryorder, MYSQLI_ASSOC);
                
                $qtycou = $objResultorder['qtycou'];

                if($qtycou != 0){
                    $output = 'คูปองไม่ถูกต้อง,';
                //    echo json_encode(['cou' => 'คูปองไม่ถูกต้อง']);
                    echo $output;
                //   echo json_encode(array('code' => 'คูปองไม่ถูกต้อง', 'message' => 'คูปองไม่ถูกต้อง'));
  
                }
                
                else{

                    $output = $amount.'@'.$type.'@'.$condition_type.'@'.$condition_min.'@'.$id_coupon.',';

                    if($condition_type == 1){

                        if($qtyproduct >  $condition_min ){
                            echo $output;
                        }else{
                            $output = 'คูปองไม่ถูกต้อง,';
                            echo $output;
                        }

                    }
                    else if($condition_type == 2){

                        if($priceall >  $condition_min ){
							echo $output;
                        }else{
                            $output = 'คูปองไม่ถูกต้อง,';
                            echo $output;
                        }

                    }else{
                        echo $output;
                    }

   //     echo json_encode(array('code' => 'คูปองไม่ถูกต้อง', 'message' => $amount.'@'.$type.'@'.$condition_type.'@'.$condition_min));
    //    echo json_encode(['cou' => $amount.'@'.$type.'@'.$condition_type.'@'.$condition_min]);

    }
            }else{
                $output = 'คูปองไม่ถูกต้อง,';
                echo $output;
            }

?>

