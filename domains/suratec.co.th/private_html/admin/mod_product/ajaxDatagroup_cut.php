<?php 
require_once '../library/connect.php';
$str = "SELECT id_description from description_cut";
$query = mysqli_query($objConnect,$str);
$output ='';

while($result = mysqli_fetch_array($query)){
	$output .= '<label style="cursor:pointer;"><input class="des_cut" type="radio" value="'.$result['id_description'].'" name="group_cut"> GROUP '.$result['id_description'].'</label><br>';
}

echo $output;
?>