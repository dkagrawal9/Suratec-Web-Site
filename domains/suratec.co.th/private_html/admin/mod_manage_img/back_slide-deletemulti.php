<?php
	require_once '../library/connect.php';

	for($i=0;$i<count($_POST["Chk"]);$i++)
	{	
		$strSQL = "SELECT * FROM images WHERE id_image = '".$_POST["Chk"][$i]."'";
		$objQuery = mysqli_query($objConnect,$strSQL);
		$objResult = mysqli_fetch_array($objQuery);
		echo $file = iconv("utf-8","tis-620",$objResult["name_image"]);
			if(unlink("../../uploads/mod_image/".$file)){
				echo "Delete image complete";
			}
		$strSQL = "DELETE FROM images ";
		$strSQL .="WHERE id_image = '".$_POST["Chk"][$i]."' ";
		$objQuery = mysqli_query($objConnect,$strSQL);
			if($objQuery){
				echo "Delete Slide complete";
			}else{
				echo "error [".$strSQL."]";			
			}
	}
	echo "Record Deleted.";


?>