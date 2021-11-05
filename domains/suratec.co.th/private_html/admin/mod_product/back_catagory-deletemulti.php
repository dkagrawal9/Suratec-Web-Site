<?php
	require_once '../library/connect.php';

	for($i=0;$i<count($_POST["Chk"]);$i++)
	{	
			$str = "SELECT * FROM product_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."' ";
			$query = mysqli_query($objConnect,$str);
			$result = mysqli_fetch_array($query);
			
				if($result['level']==1){
					$str2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$result['id_catagory']."' ";
					$query2 = mysqli_query($objConnect,$str2);

					while($result2 = mysqli_fetch_array($query2)){

						$file_level2 = iconv("utf-8","tis-620",$result2["img"]);
						if(unlink("../../uploads/category/".$file_level2)){
							echo 'ลบรูปเลเวล 2 ได้แล้ว';
						}else{
							echo '-----------------------';
						}

						$str_d_img = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$result2['id_catagory']."' ";
						$query_d_img = mysqli_query($objConnect,$str_d_img);
						while ($result_d_img3 = mysqli_fetch_array($query_d_img)) {
							if($result_d_img3!=''){
								$file_level3 = iconv("utf-8","tis-620",$result_d_img3["img"]);
								if(unlink("../../uploads/category/".$file_level3)){
									echo 'ลบรูปเลเวล 3 ได้แล้ว';
								}else{
									echo '-----------------------';
								}
							}
						}

						$str_d = "DELETE FROM product_catagory WHERE level = '3' AND group_sub = '".$result2['id_catagory']."' ";
						$query_d = mysqli_query($objConnect,$str_d);
						if($query_d){
							echo "Delete Catagory complete [".$str_d."]";
						}else{
							echo "error [".$str_d."]";			
						}
					}

					$str3 = "DELETE FROM product_catagory WHERE group_sub = '".$_POST["Chk"][$i]."' ";
					$query3 = mysqli_query($objConnect,$str3);
						if($query3){
							echo "Delete Catagory complete [".$str3."]";
						}else{
							echo "error [".$str_sub."]";			
						}

					if($result['img']!=''){
						$file_level1 = iconv("utf-8","tis-620",$result["img"]);
						if(unlink("../../uploads/category/".$file_level1)){
							echo 'ลบรูปเลเวล 1 ได้แล้ว';
						}else{
							echo '-----------------------';
						}
					}

					$strSQL = "DELETE FROM product_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."' ";
					$objQuery = mysqli_query($objConnect,$strSQL);
						if($objQuery){
							echo "Delete Catagory complete [".$strSQL."]";
						}else{
							echo "error [".$strSQL."]";			
						}

				}elseif($result['level']==2){
					$str_d_img = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$_POST["Chk"][$i]."' ";
					$query_d_img = mysqli_query($objConnect,$str_d_img);
					while ($result_d_img = mysqli_fetch_array($query_d_img)) {
						if($result_d_img!=''){
							$file_level3 = iconv("utf-8","tis-620",$result_d_img["img"]);
							unlink("../../uploads/category/".$file_level3);
						}else{
							continue;
						}
					}

					$str_sub = "DELETE FROM product_catagory WHERE level = '3' AND group_sub = '".$_POST["Chk"][$i]."' ";
					$query_sub = mysqli_query($objConnect,$str_sub);
						if($query_sub){
							echo "Delete Catagory complete [".$str_sub."]";
						}else{
							echo "error [".$str_sub."]";			
						}

					$str_level2 = "SELECT * FROM product_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."'";
					$query_level2 = mysqli_query($objConnect,$str_level2);
					$result_level2 = mysqli_fetch_array($query_level2);
					if($result_level2['img']!=''){
						$file_level2 = iconv("utf-8","tis-620",$result_level2["img"]);
						unlink("../../uploads/category/".$file_level2);
					}

					$str_sub = "DELETE FROM product_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."' ";
					$query_sub = mysqli_query($objConnect,$str_sub);
						if($query_sub){
							echo "complete".$str_sub;
						}else{
							echo "error".$str_sub;
						}
				}else{
					if($result['img']!=''){
						$file_level1 = iconv("utf-8","tis-620",$result["img"]);
						unlink("../../uploads/category/".$file_level1);
					}
					$strSQL = "DELETE FROM product_catagory WHERE id_catagory = '".$_POST["Chk"][$i]."' ";
					$objQuery = mysqli_query($objConnect,$strSQL);
						if($objQuery){
							echo "Delete Catagory complete [".$strSQL."]";
						}else{
							echo "error [".$strSQL."]";			
						}
				}
	
	}
	echo "Record Deleted.";


?>