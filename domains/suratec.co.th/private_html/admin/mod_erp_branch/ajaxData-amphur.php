<?php
require_once '../library/connect.php';
echo '<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
        <select class="form-control validate selectpicker" id="district" name="district" onchange="remove(this,"district");">';
$id = explode("-", $_POST['id']);
$str = "SELECT * FROM district WHERE AMPHUR_ID = '".$id[1]."'";
$query = mysqli_query($objConnect,$str);
	echo '<option value="">---เลือกตำบล---</option>';
while($result = mysqli_fetch_array($query)){
	echo '<option value='.$result['DISTRICT_CODE'].'-'.$result['DISTRICT_ID'].'-'.$result['DISTRICT_NAME'].'>'.$result['DISTRICT_NAME'].'</option>';
}
?>
<script type="text/javascript">
 $(document).ready(function(){
      $('#district').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });
    });
</script>