<?php	
session_start();
require_once '../library/connect.php';

@$strSQL = "SELECT * from product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
@$strQuery = mysqli_query($objConnect,$strSQL);
@$output .= '<ul class="mailbox-attachments clearfix">';

$m = 0;
while($ObjResult = mysqli_fetch_array($strQuery)){
	if(empty($ObjResult['active'])){
		$block = "";
		$check = "";
		$text = "";
	}else{
		$text = "display:block;";
		$check = "checked";
		$block = "overlay-cover";
	}
$m++;
$output .= '
				<li class="section-product-img" style="width:165px;">
					<span class="mailbox-attachment-icon has-img " style="font-size:0px; width:163px; height:100px; position:relative;">
						<img class="image-preview" src="../../uploads/product/thumbnail/'.$ObjResult['name_thumb'].'"  style="width:auto; height:auto; max-width:100%; max-height:100%; cursor: pointer;" data-id="'.$ObjResult['id_thumb'].'" data-name="'.$ObjResult['name_thumb'].'">	
						<div class="discard overlay-image'.$ObjResult['id_thumb'].' '.$block.'" >
							<div class="text-image text'.$ObjResult['id_thumb'].'" style="'.$text.'">
								<i id="check_active_true'.$ObjResult['id_thumb'].'" class="fa fa-check-circle" style="'.$text.'"></i>
								<i id="check_active'.$ObjResult['id_thumb'].'" class="fa fa-spinner fa-spin" style="color:green; display:none;"></i>			    			
				    		</div>
				    	</div>	    	 
				    </span>
				    <div align="center" style="padding-top:5px; white-space: nowrap; width: 150px; overflow: hidden;text-overflow: "..."; ">
						<p style="font-size:12px;">'.$ObjResult['name_thumb'].'</p>
					</div>
				    <div class="mailbox-attachment-info clearfix" style="background-color:#eee;  padding:0px;">
						<span class="mailbox-attachment-size" style="font-size:18px; padding-left:5px; padding-right:5px;">
							<input type="radio" name="active" id="active'.$ObjResult['id_thumb'].'" '.$check.' hidden>
							<span style="font-size:12px;">'.convert_filesize($ObjResult['size_thumb']).'</span>
							<button type"button" class="btn btn-flat del-thumb" data-id="'.$ObjResult['id_thumb'].'" style="background-color: #eee; float:right; padding:5px;"><i class="glyphicon glyphicon-trash"></i></button>
							<!--<button type"button" class="btn btn-flat" data-id="'.$ObjResult['id_thumb'].'" style="background-color: #eee; float:right; padding:5px;" onclick="openModal();currentSlide('.$m.')"><i class="glyphicon glyphicon-zoom-in"></i></button>-->
						</span>
					</div>
				</li>
			';
}
$output .= '</ul>
			<div id="myModal" class="modal-view">
  				<span class="close-set cursor" onclick="closeModal()" style=""><i class="fa fa-close"></i></span>
  				<div class="modal-content-view">';
$row = mysqli_num_rows($strQuery);
$i = 0;
$strSQL = "SELECT * from product_image_thumb";
$strQuery = mysqli_query($objConnect,$strSQL);
while($objSlide = mysqli_fetch_array($strQuery)){
$i++;
$output .='
	  				<div class="mySlides" style="width:100%; height:350px; min-width:163px;" align="center">
					    <div class="numbertext">'.$i.' / '.$row.'</div>
					    <img src="../../uploads/product/thumbnail/'.$objSlide['name_thumb'].'"style="width:auto; height:auto; max-width:100%; max-height:100%;">
					</div>
					';
}
$output .='
					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	    			<a class="next" onclick="plusSlides(1)">&#10095;</a>

	    			<div class="caption-container">
				      	<p id="caption"></p>
				    </div>';
$a = 0;
$strSQL = "SELECT * from product_image_thumb";
$strQuery = mysqli_query($objConnect,$strSQL);
while($ObjColumn = mysqli_fetch_array($strQuery)){
$a++;
$output .='
				    <div class="column" style="width:163px; height:100px; " align="center">
	      				<img class="demo cursor" src="../../uploads/product/thumbnail/'.$ObjColumn['name_thumb'].'" style="width:auto; height:auto; max-width:100%; max-height:100%;" onclick="currentSlide('.$a.')" alt="'.$ObjColumn['name_thumb'].'">
	    			</div>';
}
$output .='
    			</div>
			</div>
';	
echo $output;
function convert_filesize($size_in_byte, $precision=2){
	$units = array("GB"=>1073741824, "MB"=>10485676, "KB"=>1024);
	foreach ($units as $u => $v) {
		if($size_in_byte >= $v){
			return round(($size_in_byte/$v), $precision)." $u";
		}
	}
	// return $bytes. " Btytes";
}
?>
<!-- <div class="discard overlay-image'.$ObjResult['id_thumb'].'">
				    		<div class="text-image text'.$ObjResult['id_thumb'].'"><i class="fa fa-check-square-o">
				    			</i>&nbsp;<font size="3">ภาพหน้าปก</font>
				    		</div>
				    	</div>	 -->