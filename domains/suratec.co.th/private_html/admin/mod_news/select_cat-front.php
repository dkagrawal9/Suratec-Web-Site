<?php 
 require_once '../library/connect.php';
$strSQL = "SELECT * FROM article_catagory";
$objQuery = mysqli_query($objConnect,$strSQL);

$output = '';
$output .='<div style="overflow-x:auto;">
            <table class="table_cat">';
$output .= '<thead>
                <tr>
                 	<th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                    <th style="min-width:250px; width:60%;">'.lang('เลือกทั้งหมด','Select').'</th>
                    <th style="text-align: center; min-width:100px; width:150px;">'.lang('แก้ไขล่าสุด','Last update').'</th>
                    <th style="text-align: center; min-width:100px; width:150px;">'.lang('ควบคุม','Control').'</th>
                </tr>
            <thead>
            <tbody>
 		';
 		$i=0;
while ($objResult = mysqli_fetch_array($objQuery)) {
	$i++;
$output .= '<tr class="show-tr">

              <td style="text-align: center;">
                <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk'.$i.'" value="'.$objResult['id_catagory'].'">
              </td>
             
              <td>
                <img src="../img/folder.png" width="25px" height="25px">&emsp;'.lang($objResult["name_catagory"],$objResult['name_catagory_en']).'
              </td>

              <td style="text-align: center;">
                '.$objResult["date_catagory"].'
              </td>

              <td style="text-align: center;">
                <div class="btn-group">
                    <button style="background-color: white;" type="button" class="edit-catagory btn btn-default" id="" data-id="'. $objResult['id_catagory'].'" data-name="'. $objResult['name_catagory'].'" data-name-en="'. $objResult['name_catagory_en'].'">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-default delete-catagory" data-id="'.$objResult['id_catagory'].'"><i class="fa fa-remove"></i></button>
                </div>
              </td>

            </tr>';                 
}
$output .='<tbody>
		</table>
    </div>
		<input type="hidden" name="hdnCount" value="'.$i.'">
		';
echo $output;
                