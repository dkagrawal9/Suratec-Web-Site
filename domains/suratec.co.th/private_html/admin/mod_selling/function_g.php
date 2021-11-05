<?php
session_start();

// require_once 'admin/library/connect.php';
date_default_timezone_set("Asia/Bangkok");


if(isset($_POST['_method'])){

    if($_POST['_method']=='SELECT_ATTR'){
    SELECT_ATTR();
	 	exit;
    }elseif($_POST['_method']=='SELECT_ADDRESS'){
    SELECT_ADDRESS();
    exit;
    }elseif($_POST['_method']=='SELECT_SHIPPING'){
    SELECT_SHIPPING();
    exit;
    }elseif($_POST['_method']=='CREATE_SUP_ITEM'){
    CREATE_SUP_ITEM();
    exit;
    }elseif($_POST['_method']=='CONFIRM_ORDER'){
      CONFIRM_ORDER();
    exit;
    }elseif($_POST['_method']=='ADD_NUMBER_PARCEL'){
      ADD_NUMBER_PARCEL();
    exit;
    }elseif($_POST['_method']=='EDIT_NUMBER_PARCEL'){
      EDIT_NUMBER_PARCEL();
    exit;
    }elseif($_POST['_method']=='VIEW_DETAIL'){
      VIEW_DETAIL();
    exit;
    }elseif($_POST['_method']=='VIEW_DETAIL_ORDER'){
      VIEW_DETAIL_ORDER();
    exit;
    }elseif($_POST['se_method']=='SE_DETAIL_ORDER'){
      SE_DETAIL_ORDER();
    exit;
    }elseif($_POST['_method']=='DELETE_DETAIL_HIS'){
      DELETE_DETAIL_HIS();
    exit;
    }elseif($_POST['_method']=='SELECT_PRODUCT'){
      SELECT_PRODUCT();
    exit;
    }elseif($_POST['_method']=='CON_EDIT_SE'){
      CON_EDIT_SE();
    exit;
    }elseif($_POST['_method']=='UPDATE_ST'){
      UPDATE_ST();
    exit;
    }
    
    
}


function UPDATE_ST(){
	require_once '../library/connect.php';    
	header('Content-Type: application/json');
	$date = date("Y-m-d H:i:s");


	$str = "UPDATE mod_order SET ";
	
       $str .= "con_st = '".$_POST['con_st']."' ";
     // $str .= "status = 'complete_spending' ";
			$str .= "WHERE id_order = '".$_GET['id_order']."'";

			$query = mysqli_query($objConnect,$str);


      // if($query){
      //   $sql = "UPDATE  product_stock_branch set order_stock = order_stock +'" + amount + "'   
      //   where product_stock_branch.id_branch =  '"+Program.idBranch+"'  AND id_product_attr = '" + id_attr + "' ";
      // }

	if($query){
		echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
	}else{
		echo json_encode(array('status' => '0','message'=> "ERROR: ".$str));
	}
}



function CON_EDIT_SE(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


  $sql =  "SELECT con_st FROM mod_order WHERE id_order = '".$_GET['id_order']."'";

  $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
//  while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      array_push($resultArray, $result);
 //}
 echo json_encode(['data'=> $resultArray]);
}


function SELECT_PRODUCT(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


//  $sql = "SELECT * FROM product  
// LEFT JOIN product_image ON product.id_product = product_image.id_product
// LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product
// LEFT JOIN product_stock_branch ON product_stock_branch.id_product = product.id_product
// WHERE product.delete_datetime is null and  product.id_product = '".$_POST['option']."' 
// GROUP BY product_attribute.id_attr";

$sql = "SELECT *,mod_erp_branch.id_branch as id_branch_st  FROM  product
LEFT JOIN product_image ON product.id_product = product_image.id_product
LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product
LEFT JOIN mod_erp_branch ON product.id_branch = mod_erp_branch.id_branch
WHERE product.id_branch='".$_POST['option']."' 
and product.delete_datetime is null 
GROUP BY product.id_product
order by  product.id_product asc";

//echo  $sql;

$resultArray = array();
$query = mysqli_query($objConnect,$sql);
while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
   //  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
    array_push($resultArray, $result);
}
echo json_encode(['data'=> $resultArray]);


 }




function SELECT_ATTR(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


 $sql = "SELECT * FROM product  
LEFT JOIN product_image ON product.id_product = product_image.id_product
LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product
LEFT JOIN product_stock_branch ON product_stock_branch.id_product = product.id_product
WHERE product.delete_datetime is null and  product.id_product = '".$_POST['option']."' 
GROUP BY product_attribute.id_attr";


 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    //  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);
 }
 echo json_encode(['data'=> $resultArray]);


}



function SELECT_ADDRESS(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


$sql = "SELECT * FROM mod_customer_address  
WHERE mod_customer_address.delete_datetime is null and  mod_customer_address.id_customer = '".$_POST['option']."' ";


 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    //  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);
 }
 echo json_encode(['data'=> $resultArray]);


}


function SELECT_SHIPPING(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


 $sql = "SELECT * FROM mod_shipping  

WHERE delete_datetime is null and  id_shipping = '".$_POST['option']."' ";

//echo  $sql;

 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    //  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);
 }
 echo json_encode(['data'=> $resultArray]);


}





function CREATE_SUP_ITEM() {
  require_once '../library/connect.php';    
  header('Content-Type: application/json');
  $date = date("Y-m-d H:i:s");
  

	$sql="INSERT INTO `mod_order`(`id_order`, `order_datetime`, `id_customer`, `id_address`, `id_shipping`, `payment`, `status`, `priceall` , `id_branch`) 

	VALUES (
    '".$_POST['bl_number']."',
    '".$date."',
    '".$_POST['id_customer']."',
    '".$_POST['id_address']."',
    '".$_POST['id_shipping']."',
    '".$_POST['payment']."',
    'new_pending',
    '".$_POST['sum_all']."',
    '".$_POST['id_branch']."'
    )";


	$query=mysqli_query($objConnect, $sql);

	// if($query) {
	// 	echo json_encode(array('status'=> '1', 'message'=> $sql));
	// }

	// else {
	// 	echo json_encode(array('status'=> '0', 'message'=> $sql));
	// }

		 $readjson = $_POST['products'];

		 $data = json_decode($readjson, true);
		 //print_r($data);
		$product = $_POST['products'];
		for($i=0; $i < count($data); $i++) {


			$str="INSERT INTO `mod_order_item`(`id_order`, `id_product`, `qty`, `price`, `subtotal` , `id_product_attr`) 
			VALUES ('".$_POST['bl_number']."',
			'".$data[$i]['product_id']."',
			'".$data[$i]['qty']."',
      '".$data[$i]['product_price']."',
			'".$data[$i]['sum']."',
      '".$data[$i]['id_attr']."'
      )";
      
      // echo $sql;
       
			$queryi=mysqli_query($objConnect, $str);

			if($queryi) {
				echo json_encode(array('status'=> '1', 'message'=> $str));
			}
			else {
				echo json_encode(array('status'=> '0', 'message'=> $str));
			}
		}
 }


function CONFIRM_ORDER(){
	require_once '../library/connect.php';    
	header('Content-Type: application/json');
	$date = date("Y-m-d H:i:s");


	$str = "UPDATE mod_order SET ";
	
       $str .= "status = 'wait_shipping' ";
     // $str .= "status = 'complete_spending' ";
			$str .= "WHERE id_order = '".$_GET['id_order']."'";

			$query = mysqli_query($objConnect,$str);


      // if($query){
      //   $sql = "UPDATE  product_stock_branch set order_stock = order_stock +'" + amount + "'   
      //   where product_stock_branch.id_branch =  '"+Program.idBranch+"'  AND id_product_attr = '" + id_attr + "' ";
      // }

      if ($query) {
        $sql_m = "SELECT * FROM mod_order_item WHERE id_order = '".$_GET['id_order']."' ";
        $query_m = mysqli_query($objConnect,$sql_m);

        $cmd = "SELECT id_branch FROM mod_order WHERE id_order = '".$_GET['id_order']."' AND delete_datetime IS NULL LIMIT 1";
        $query_cmd = mysqli_query($objConnect,$cmd);
        $result_cmd = mysqli_fetch_array($query_cmd);


        while($result_m = mysqli_fetch_array($query_m)){
          $sql_stock = "UPDATE product_stock_branch SET order_stock=order_stock+'".$result_m['qty']."' WHERE id_product_attr = '".$result_m['id_product_attr']."' AND id_branch = '".$result_cmd['id_branch']."'";
          $query_stock = mysqli_query($objConnect,$sql_stock);
        }

      }

	if($query){
		echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
	}else{
		echo json_encode(array('status' => '0','message'=> "ERROR: ".$str));
	}
}


// string 
// sql3 = "UPDATE  product_stock_branch set order_stock = order_stock+'" + amount + "'   
// where product_stock_branch.id_branch =  '"+Program.idBranch+"'  AND id_product_attr = '" + id_attr + "' ";

function EDIT_NUMBER_PARCEL(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


 $sql = "SELECT * FROM mod_order  WHERE id_order = '".$_GET['add_id_order']."' ";

//echo  $sql;

 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 //while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);
 //}
 echo json_encode(['data'=> $resultArray]);


}





function ADD_NUMBER_PARCEL() {
  require_once '../library/connect.php';    
  header('Content-Type: application/json');
  $date = date("Y-m-d H:i:s");


  
	$str = "UPDATE mod_order SET ";
	
			$str .= "tracking_number = '".$_POST['value']."' ";
			$str .= "WHERE id_order = '".$_GET['add_id_order']."'";
  
  // echo $sql;
   
  $queryi=mysqli_query($objConnect, $str);

  if($queryi) {
    echo json_encode(array('status'=> '1', 'message'=> $str));
  }
  else {
    echo json_encode(array('status'=> '0', 'message'=> $str));
  }

}

function VIEW_DETAIL(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


 $sql = "SELECT * FROM mod_order_slip  WHERE id_order = '".$_GET['view_id_order']."' ";

//echo  $sql;

 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 //while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);
 //}
 echo json_encode(['data'=> $resultArray]);
}



function VIEW_DETAIL_ORDER(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');


 $sql = "SELECT *,mod_order.status as status_dl ,mod_shipping.name_shipping AS name_shipping , mod_shipping.price AS price_shipping FROM mod_order  
 LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
 LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
 LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
 LEFT JOIN mod_shipping ON mod_shipping.id_shipping = mod_order.id_shipping

LEFT JOIN product ON product.id_product = mod_order_item.id_product
LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product


 WHERE mod_order.id_order = '".$_GET['view_id_order']."' ";

//echo  $sql;

 $resultArray = array();
 $query = mysqli_query($objConnect,$sql);
 while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    //$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
     array_push($resultArray, $result);

    // echo 1 ;
 }
 echo json_encode(['data'=> $resultArray]);
}



// function SE_DETAIL_ORDER(){
//   require_once '../library/connect.php';    
//   header('Content-Type: application/json');


//  $sql = "SELECT *,mod_order.status as status_dl FROM mod_order  
//  LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
//  LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
//  LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
//  WHERE mod_order.id_order = '".$_GET['view_id_order']."' ";

// //echo  $sql;

//  $resultArray = array();
//  $query = mysqli_query($objConnect,$sql);
//  //while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
//     $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
//      array_push($resultArray, $result);
//  //}
//  echo json_encode(['data'=> $resultArray]);
// }

function  DELETE_DETAIL_HIS(){
  require_once '../library/connect.php';    
  header('Content-Type: application/json');
  $date = date("Y-m-d H:i:s");


  
	$str = "UPDATE mod_order SET ";
	
  $str .= "delete_datetime = '$date' ";
  $str .= "WHERE id_order = '".$_GET['id_order']."'";

  $query = mysqli_query($objConnect,$str);



if($query){
echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
}else{
echo json_encode(array('status' => '0','message'=> "ERROR: ".$str));
}

}