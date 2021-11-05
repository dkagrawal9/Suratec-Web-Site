<?php
require_once '../library/connect.php';
?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->


<!-- <select class="multiSelect" multiple style="width: 300px"> -->

  

<?php

	

$sql = "SELECT * FROM `aria` WHERE id = '".$_GET["aria_geo"]."' ";
$query = mysqli_query($objConnect, $sql);
$result = mysqli_fetch_array($query);

echo $provinces_aria = substr($result["provinces"], 0, -1);	

 echo $sql2 = "SELECT * FROM  provinces  WHERE provinces.id IN ($provinces_aria) ";
 $query2 = mysqli_query($objConnect, $sql2);
 while ($result2 = mysqli_fetch_array($query2)) {
?>
     <option value="<?php echo $result2['id'] ?> "><?php echo $result2['name_th'] ?></option>
<?php } 
?>
<!-- </select> -->

<!-- <script type="text/javascript">
	$('.multiSelect').select2();
</script> -->