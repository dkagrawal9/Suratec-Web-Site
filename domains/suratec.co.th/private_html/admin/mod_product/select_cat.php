
<?php 
require_once '../library/connect.php';
$strSQL = "SELECT * FROM product_catagory WHERE level = '1' AND  `id_branch`=''";
$objQuery = mysqli_query($objConnect,$strSQL);

$output = '';
$i = 0;
while ($objResult = mysqli_fetch_array($objQuery)) {
$i++;
$output .= '
				 <div class="form-group">
                    <label style="cursor:pointer; font-weight:normal !important;">
                       <input id="id_product-catagory'.$i.'" class="check_cat check_top1'.$objResult["id_catagory"].'" 
                       												data-lev="1" 
                       												name="id_product-catagory" 
                       												value="'.$objResult["id_catagory"].'" 
                       												type="checkbox" 
                       												>     
                    &nbsp;'.$objResult["name_catagory"].'
                    </label>
                  </div>
                ';      
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
	$strSQL2 = "SELECT * FROM product_catagory WHERE level ='2' AND group_sub = '".$objResult['id_catagory']."' AND  `id_branch`=''";
	$objQuery2 = mysqli_query($objConnect,$strSQL2);
	while ($objResult2 = mysqli_fetch_array($objQuery2)) {      
	$i++;
	$output .= '
					 <div class="form-group" style="padding-left:25px;">
	                    <label style="cursor:pointer; font-weight:normal !important;">
	                       <input id="id_product-catagory'.$i.'" class="check_cat check_top2'.$objResult2["id_catagory"].' 
	                       												check_top2-ex2'.$objResult2["id_catagory"].' 
		                       											check_top2-ex1'.$objResult["id_catagory"].'"
	                       												data-lev="2" 
	                       												data-top="'.$objResult['id_catagory'].'" 
	                       												name="id_product-catagory" 
	                       												value="'.$objResult2["id_catagory"].'" 
	                       												type="checkbox">     
	                    &nbsp;'.$objResult2["name_catagory"].'
	                    </label>
	                  </div>
	                '; 
//------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
		$strSQL3 = "SELECT * FROM product_catagory WHERE level ='3' AND group_sub = '".$objResult2['id_catagory']."' AND  `id_branch`=''";
		$objQuery3 = mysqli_query($objConnect,$strSQL3);
		while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
		$i++;   
		$output .= '
						 <div class="form-group" style="padding-left:50px;">
		                    <label style="cursor:pointer; font-weight:normal !important;">
		                       <input id="id_product-catagory'.$i.'" class="check_cat check_top3'.$objResult3["id_catagory"].' 
		                       												check_top3-ex2'.$objResult2["id_catagory"].' 
		                       												check_top3-ex1'.$objResult["id_catagory"].'"
		                       												data-lev="3" 
		                       												data-top="'.$objResult2['id_catagory'].'" 
		                       												name="id_product-catagory"
		                       												value="'.$objResult3["id_catagory"].'" 
		                       												type="checkbox">     
		                    &nbsp;'.$objResult3["name_catagory"].'
		                    </label>
		                  </div>
		                '; 
		}
    }     
}
$output .='	<input id="count_cat" type="hidden" value="'.$i.'">';
echo $output;
?>