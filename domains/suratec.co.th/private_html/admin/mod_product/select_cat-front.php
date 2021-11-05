<?php 
require_once '../library/connect.php';

$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];

 $strSQL = "SELECT * FROM product_catagory WHERE level = '1' AND id_catagory NOT IN('14','15','16') AND  `id_branch`=''";
$objQuery = mysqli_query($objConnect,$strSQL);

$output = '';
$output .='<div style="overflow-x:auto;">
            <table class="table" id="table-search">';
$output .= '<thead>
                <tr style="background-color:#F5F5F5 !important; color:black !important;">
                 	<th style="text-align: center; min-width:20px; width:20px; border-bottom:none;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                    <th style="min-width:250px; width:10%; border-bottom:none;">รูปภาพ</th>
                    <!--<th style="text-align: center; min-width:100px; width:150px; border-bottom:none;">หมวดหมู่ของ..</th>-->
                    <th style="text-align: center; min-width:50px; width:50px; border-bottom:none;">หมวดหมู่หลัก </th>
                    <th style="text-align: center; min-width:50px; width:50px; border-bottom:none;">ชื่อหมวดหมู่</th>
                    <th style="text-align: center; min-width:50px; width:50px; border-bottom:none;">ควบคุม</th>
                </tr>
            <thead>
            <tbody>
 		';
 		$i=0;
while ($objResult = mysqli_fetch_array($objQuery)) {
	$i++;
$output .= '<tr class="show-tr">

              <td style="text-align: center;">
                <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk'.$i.'" value="'.$objResult['id_catagory']. '">
              </td>
              <td>
              <img src="../../uploads/category/'.$objResult["img"].'" width="20" height="20"> 
              </td>

              <td>
            <!-- &emsp; -->' .$objResult["name_catagory"].'
                <!--<div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat" value="'.$objResult["name_catagory"].'" style="border:none; background: transparent;" data-id="'.$objResult['id_catagory'].'">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat_en" value="'.$objResult["name_catagory_en"].'" style="border:none; background: transparent;" data-id="'.$objResult['id_catagory'].'" data-en="en">
                  </div>
                </div>-->
              </td>
              <td></td>

              <!--<td style="text-align: center;">
                <select class="form-control updateCat_sub" name="menu_sub" style="border:1px solid #f4f4f4;">
                  <option value="0">หมวดหมู่หลัก</option>';        

    $Choice1 = "SELECT * FROM product_catagory WHERE level = '1' AND  `id_branch`=''";
    $queryChoice1 = mysqli_query($objConnect,$Choice1);          
    while ($resultChoice1 = mysqli_fetch_array($queryChoice1)) {
      if($resultChoice1['id_catagory'] == $objResult['id_catagory']){
        $disabled = "disabled";
      }else{
        $disabled = "";
      }
    $output .= '<option value="1-'.$resultChoice1['id_catagory'].'-'.$objResult['id_catagory'].'" '.$disabled.' data-id="'.$resultChoice1['level'].'">'.$resultChoice1['name_catagory'].'</option>';

        $Choice2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$resultChoice1['id_catagory']."' AND  `id_branch`=''";
        $queryChoice2 = mysqli_query($objConnect,$Choice2);          
        while ($resultChoice2 = mysqli_fetch_array($queryChoice2)) {
          if($resultChoice2['group_sub'] == $objResult['id_catagory']){
            $disabled = "disabled";
          }else{
            $disabled = "";
          }
        $output .= '<option value="2-'.$resultChoice2['id_catagory'].'-'.$objResult['id_catagory'].'" '.$disabled.' data-id="'.$resultChoice2['level'].'">- '.$resultChoice2['name_catagory'].'</option>';

            $Choice3 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$resultChoice2['id_catagory']."' AND  `id_branch`=''";
            $queryChoice3 = mysqli_query($objConnect,$Choice3);          
            while ($resultChoice3 = mysqli_fetch_array($queryChoice3)) {
            $output .= '<option disabled>&nbsp;&nbsp;- '.$resultChoice3['name_catagory'].'</option>';
            }
        }
    }

    $output .= ' </select>
              </td>-->
              <td style="text-align: center;">
                <div class="btn-group"> 
                     <button type="button" class="btn btn-default show-catagory btn-sm" style="background-color: white; '.$input_read.'" data-id="'.$objResult['id_catagory'].'"><i class="fa fa-fw fa-eye"></i></button>

                    <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white;  '.$button_edit.'" data-id="'.$objResult['id_catagory'].'"><i class="fa fa-edit"></i></button>

                    <button style="'.$button_del.'" type="button" class="btn btn-default delete-catagory btn-sm" data-id="'.$objResult['id_catagory'].'"><i class="fa fa-remove"></i></button>
                </div>
              </td>

            </tr>'; 
//------------------------------------------------------------------------------------------------sub 2------------------------------------------------------------------------------------
$strSQL1 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$objResult['id_catagory']."' AND  `id_branch`=''";
$objQuery1 = mysqli_query($objConnect,$strSQL1);
while($objResult1 = mysqli_fetch_array($objQuery1)){
$i++;
    $output .= '<tr style="background:#fbfcfd;"  class="show-tr">

              <td style="text-align: center;">
                <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk'.$i.'" value="'.$objResult1['id_catagory']. '">
              </td>

               
              <td>
              <div class="input-group">
                <span class="input-group-addon" style="border:none; background:transparent; padding-left:0;">
                  <i class="fa fa-level-up" id="share"></i>
                </span>
                &nbsp;<img src="../../uploads/category/'.$objResult1["img"].'" width="20" height="20"> &emsp;
                <!--<div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat" value="'.$objResult1["name_catagory"].'" style="border:none; background: transparent;" data-id="'.$objResult1['id_catagory'].'">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat_en" value="'.$objResult1["name_catagory_en"].'" style="border:none; background: transparent;" data-id="'.$objResult1['id_catagory'].'" data-en="en">
                  </div>
                </div>-->
              </div>
              </td>
              <td>
              ' .$objResult["name_catagory"].'
              </td>
              <td>
              ' .$objResult1["name_catagory"].'
              </td>

             <!-- <td style="text-align: center;">
                <select class="form-control updateCat_sub" name="menu_sub" style="border:1px solid #f4f4f4;">
                  <option value="0-0-'.$objResult1['id_catagory'].'">หมวดหมู่หลัก</option>';   
    
    $Choice1 = "SELECT * FROM product_catagory WHERE level = '1' AND  `id_branch`=''";
    $queryChoice1 = mysqli_query($objConnect,$Choice1);          
    while ($resultChoice1 = mysqli_fetch_array($queryChoice1)) {
        if($resultChoice1['id_catagory']==$objResult1['group_sub']){
          $select = "selected";
          $disabled = "disabled";
        }else{
          $select = "";
          $disabled = "";
        }   
    $output .= '<option value="1-'.$resultChoice1['id_catagory'].'-'.$objResult1['id_catagory'].'" '.$select.' '.$disabled.'>'.$resultChoice1['name_catagory'].'</option>';

        $Choice2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$resultChoice1['id_catagory']."' AND  `id_branch`=''";
        $queryChoice2 = mysqli_query($objConnect,$Choice2);          
        while ($resultChoice2 = mysqli_fetch_array($queryChoice2)) {
          if($resultChoice2['id_catagory'] == $objResult1['id_catagory']){
            $disabled = "disabled";
          }else{
            $disabled = "";
          }
        $output .= '<option value="2-'.$resultChoice2['id_catagory'].'-'.$objResult1['id_catagory'].'" '.$disabled.'>- '.$resultChoice2['name_catagory'].'</option>';

            $Choice3 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$resultChoice2['id_catagory']."' AND  `id_branch`=''";
            $queryChoice3 = mysqli_query($objConnect,$Choice3);          
            while ($resultChoice3 = mysqli_fetch_array($queryChoice3)) {
            $output .= '<option disabled>&nbsp;&nbsp;- '.$resultChoice3['name_catagory'].'</option>';
            }
        }
    }
    $output .= ' </select>
              </td>-->
              <td style="text-align: center;">
                <div class="btn-group">
                <button type="button" class="btn btn-default show-catagory btn-sm" style="background-color: white; '.$input_read.'" data-id="'.$objResult1['id_catagory'].'"><i class="fa fa-fw fa-eye"></i></button>
                    <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white; '.$button_edit.'" data-id="'.$objResult1['id_catagory'].'"><i class="fa fa-edit"></i></button>
                    <button style="'.$button_del.'" type="button" class="btn btn-default delete-catagory btn-sm" data-id="'.$objResult1['id_catagory'].'"><i class="fa fa-remove"></i></button>
                </div>
              </td>

            </tr>'; 
//-------------------------------------------------------------------------------------------sub 3------------------------------------------------------------------------------------
$strSQL2 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$objResult1['id_catagory']."' AND  `id_branch`=''";
$objQuery2 = mysqli_query($objConnect,$strSQL2);
while($objResult2 = mysqli_fetch_array($objQuery2)){
$i++;
    $output .= '<tr style="background:#fcfcfc;"  class="show-tr">

              <td style="text-align: center;">
                <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk'.$i.'" value="'.$objResult2['id_catagory']. '">
              </td>
             
              <td>
              <div class="input-group" style="padding-left:18px;">
                <span class="input-group-addon" style="border:none; background:transparent;">
                  <i class="fa fa-level-up" id="share"></i>
                </span>
                &nbsp;<img src="../../uploads/category/'.$objResult2["img"].'" width="20" height="20">&emsp;
               <!-- <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat" value="'.$objResult2["name_catagory"].'" style="border:none; background: transparent;" data-id="'.$objResult2['id_catagory'].'">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control updateCat_en" value="'.$objResult2["name_catagory_en"].'" style="border:none; background: transparent;" data-id="'.$objResult2['id_catagory'].'" data-en="en">
                  </div>
                </div>-->
              </div>
              </td>
              <td>' .$objResult["name_catagory"].' - ' .$objResult1["name_catagory"].'</td>
              <td>' .$objResult2["name_catagory"].'</td>

             <!-- <td style="text-align: center;">
                <select class="form-control updateCat_sub" name="menu_sub" style="border:1px solid #f4f4f4;">
                  <option value="0-0-'.$objResult2['id_catagory'].'">หมวดหมู่หลัก</option>';   
    
    $Choice1 = "SELECT * FROM product_catagory WHERE level = '1' AND  `id_branch`=''";
    $queryChoice1 = mysqli_query($objConnect,$Choice1);          
    while ($resultChoice1 = mysqli_fetch_array($queryChoice1)) {
        // if($resultChoice1['id_catagory']==$objResult1['group_sub'] && $objResult1['id_catagory'] == $objResult2['group_sub']){
        //     $disabled = "disabled";
        // }else{
        //     $disabled = "";
        //   }   
    $output .= '<option value="1-'.$resultChoice1['id_catagory'].'-'.$objResult2['id_catagory'].'" >'.$resultChoice1['name_catagory'].'</option>';

            $Choice2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$resultChoice1['id_catagory']."' AND  `id_branch`=''";
            $queryChoice2 = mysqli_query($objConnect,$Choice2);          
            while ($resultChoice2 = mysqli_fetch_array($queryChoice2)) {
              if($resultChoice2['id_catagory']==$objResult2['group_sub']){
                $select = "selected";
                $disabled = "disabled";
              }else{
                  $select = "";
                  $disabled = "";
              }   
            $output .= '<option value="2-'.$resultChoice2['id_catagory'].'-'.$objResult2['id_catagory'].'" '.$select.' '.$disabled.'>- '.$resultChoice2['name_catagory'].'</option>';

            $Choice3 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$resultChoice2['id_catagory']."' AND  `id_branch`=''";
            $queryChoice3 = mysqli_query($objConnect,$Choice3);          
            while ($resultChoice3 = mysqli_fetch_array($queryChoice3)) {
            $output .= '<option disabled>&nbsp;&nbsp;- '.$resultChoice3['name_catagory'].'</option>';
            }
        }
    }
    $output .= ' </select>
              </td>-->
              <td style="text-align: center;">
                <div class="btn-group">
                <button type="button" class="btn btn-default show-catagory btn-sm" style="background-color: white; '.$input_read.'" data-id="'.$objResult2['id_catagory'].'"><i class="fa fa-fw fa-eye"></i></button>
                    <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white; '.$button_edit.'" data-id="'.$objResult2['id_catagory'].'"><i class="fa fa-edit"></i></button>
                    <button style="'.$button_del.'" type="button" class="btn btn-default delete-catagory btn-sm" data-id="'.$objResult2['id_catagory'].'"><i class="fa fa-remove"></i></button>
                </div>
              </td>

            </tr>'; 
    }
  }
}
$output .='<tbody>
		</table>
    </div>
		<input type="hidden" name="hdnCount" value="'.$i.'">
		';
echo $output;
                