
<?php
require_once '../library/connect.php';
$id = explode("-", $_POST['id']);
$str = "SELECT * FROM amphur WHERE PROVINCE_ID = '".$id[1]."'";
 echo '<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
 		<select class="form-control validate selectpicker amphur-beta" id="amphur" name="amphur" onchange="remove(this,"amphur","post");">';
                                  
$query = mysqli_query($objConnect,$str);
	echo '<option value="">---เลือกอำเภอ---</option>';
while($result = mysqli_fetch_array($query)){
	echo '<option value='.$result['AMPHUR_CODE'].'-'.$result['AMPHUR_ID'].'-'.$result['AMPHUR_NAME'].'>'.$result['AMPHUR_NAME'].'</option>';
}
	echo '</select>';
?>
<script type="text/javascript">
 $(document).ready(function(){
      $('#amphur').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });
    });
</script>