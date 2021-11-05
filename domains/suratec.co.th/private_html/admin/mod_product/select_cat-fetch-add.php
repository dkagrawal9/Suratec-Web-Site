<?php       
$output ='';
$output .= '
        <select id="basic2" name="sub_catagory" class="selectpicker show-tick form-control" data-live-search="true">
          <option value="0" selected>จัดเป็นหมวดหมู่หลัก</option>   ';
require_once '../library/connect.php';
$strSQL = "SELECT * FROM product_catagory WHERE level = '1' AND  `id_branch`=''";
$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
while($objResult = mysqli_fetch_array($objQuery))
    {
$output .= '<option value="1-'.$objResult["id_catagory"].'">'.$objResult["name_catagory"].'</option>
            ';
      $strSQL1 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$objResult['id_catagory']."' AND  `id_branch`=''";
      $objQuery1 = mysqli_query($objConnect,$strSQL1) or die (mysqli_error());
      while($objResult1 = mysqli_fetch_array($objQuery1))
          {
      $output .= '<option value="2-'.$objResult1["id_catagory"].'">- '.$objResult1["name_catagory"].'</option>
                  ';
                  $strSQL2 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$objResult1['id_catagory']."' AND  `id_branch`=''";
                  $objQuery2 = mysqli_query($objConnect,$strSQL2) or die (mysqli_error());
                  while($objResult2 = mysqli_fetch_array($objQuery2))
                      {
                  $output .= '<option value="'.$objResult2["id_catagory"].'" disabled>&nbsp;&nbsp;- '.$objResult2["name_catagory"].'</option>
                              ';
                      }
          }
    }
    $output .= '</select>';
    echo $output;
?>   
<script type="text/javascript">
 $(document).ready(function(){
      $('#basic2').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });
    });
</script>