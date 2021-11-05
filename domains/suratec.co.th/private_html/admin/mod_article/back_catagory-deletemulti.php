<?php
	require_once '../library/connect.php';

	for($i=0;$i<count($_POST["Chk"]);$i++)
	{	
	
		$strSQL = "DELETE FROM article_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."' ";
		$objQuery = mysqli_query($objConnect,$strSQL);
			if($objQuery){
				echo "Delete Catagory complete [".$strSQL."]";
			}else{
				echo "error [".$strSQL."]";			
			}
	}
	echo "Record Deleted.";


?>