<?php 
	 require_once '../library/connect.php';
	  global $objConnect;
	 global $date;

	 $str = "UPDATE `link_local` SET`link`= '".$_POST["link_freedom_page"]."' WHERE id_link ='".$_POST["id_link_freedom_page"]."'";
	$objQuery = mysqli_query($objConnect,$str);

	$strSQL = "UPDATE freedom_page SET";
	$strSQL .= " name_page = '".$_POST["web_head_th"]."' ";
	$strSQL .= " ,name_en_page = '".$_POST["web_head_en"]."' ";
	$strSQL .= " ,text = '".htmlspecialchars($_POST["editor"], ENT_QUOTES)."' ";
	$strSQL .= " ,text_en = '".htmlspecialchars($_POST["editor_en"], ENT_QUOTES)."' ";
	$strSQL .= " ,date = '$date' ";
	$strSQL .= " ,id_link = '".$_POST["id_link_freedom_page"]."' ";
	$strSQL .= "WHERE id_page = '".$_POST['id_page']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "save done.<br> [".$strSQL."]";
		
	}
	else{
		echo "save error [".$strSQL."]";
	}
	//
	
	
?>