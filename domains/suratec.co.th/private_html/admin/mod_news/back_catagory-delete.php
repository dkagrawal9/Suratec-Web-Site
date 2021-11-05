<?php
 require_once '../library/connect.php';
	$strSQL = "DELETE FROM article_catagory WHERE id_catagory = '".$_POST["id_del_catagory"]."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
		if($objQuery){
			echo "Delete Catagory complete [".$strSQL."]";
		}else{
			echo "error [".$strSQL."]";			
		}
?>