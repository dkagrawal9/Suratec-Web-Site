<?php
$output = '';
require_once '../library/connect.php';
$strSQL = "SELECT * FROM product_catagory WHERE level = '1' AND id_catagory NOT IN('14','15','16')";
$objQuery = mysqli_query($objConnect , $strSQL);

// $output = '<input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">';
$i = 0;
while ( $objResult = mysqli_fetch_array($objQuery) ) {
	$i++;

	$strSQLnumsub = "SELECT id_catagory,group_sub FROM product_catagory WHERE group_sub = '" . $objResult['id_catagory'] . "'";
	$objQuerysub = mysqli_query($objConnect , $strSQLnumsub);
	$numsub = mysqli_num_rows($objQuerysub);

	if ($objResult['icon'] == '') {
		$color = 'bg-yellow';
	} else {
		$color = 'bg-aqua';
	}
	$output .= '<div class="search-text-widget">
            <p style="display:none;">' . $objResult["name_catagory"] . '</p>
            <div class="info-box">
              <span class="info-box-icon ' . $color . ' ch-icon" style="cursor:pointer;" data-id="' . $objResult['id_catagory'] . '">';
	if ($objResult['icon'] == '') {
		$output .= '<div style="position:absolute;margin-top:-10px; margin-left:20px;"><font style="font-size:14px;">No icon</font></div>';
	} else {
		$output .= '' . $objResult['icon'] . '';
	}
	$output .= '
                <!-- <i class="fa fa-sort-down " style="font-size:15px; margin-top:-17px; margin-left:-6px; position:absolute;"></i> -->
              </span>
              <div class="info-box-content" style="padding-bottom:0px;">
                <span class="info-box-text">
                  <span class="info-box-number">
                    <a href="#" data-id="' . $objResult['id_catagory'] . '" style="color:gray;" class="edit-catagory">' . $objResult["name_catagory"] . '</a>
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white;" data-id="' . $objResult['id_catagory'] . '"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-default delete-catagory btn-sm" data-id="' . $objResult['id_catagory'] . '"><i class="fa fa-remove"></i></button>
                </div>
                </span>
                  มี ' . $numsub . ' หมวดหมู่ย่อย
                </span>
                <span class="info-box-text open-sub" style="width:100%; margin-top:-50px; padding-top:40px; text-align:center; height:89px; color:#ddd; cursor:pointer" data-id="' . $objResult['id_catagory'] . '">
                <br>
                <i class="fa fa-sort-down " ></i>
                </span>
              </span>

                <div class="row" style="display:none;">
                  <div class="col-md-4">
                    <!-- <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $i . '" value="' . $objResult['id_catagory'] . '"> -->
                      
                      <span>
                        <input type="text" class="form-control updateCat" value="' . $objResult["name_catagory"] . '"  data-id="' . $objResult['id_catagory'] . '">
                      </span>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control updateCat_en" value="' . $objResult["name_catagory_en"] . '"  data-id="' . $objResult['id_catagory'] . '" data-en="en">
                  ';
	$output .= '
                <select class="form-control updateCat_sub" name="menu_sub" style="border:1px solid #f4f4f4;">
                  <option value="0">หมวดหมู่หลัก</option>';

	$output .= ' </select>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="box-tr-show box-tr' . $objResult['id_catagory'] . '" style="border:none; display:none;">';

//------------------------------------------------------------------------------------------------sub 2------------------------------------------------------------------------------------
	$strSQL1 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '" . $objResult['id_catagory'] . "'";
	$objQuery1 = mysqli_query($objConnect , $strSQL1);
	while ( $objResult1 = mysqli_fetch_array($objQuery1) ) {
		$i++;
		$output .= '
        <div>
        <div class="search-text-widget">
            <p style="display:none;">' . $objResult1["name_catagory"] . '</p>
          <div class="box box-success box-solid" style="padding:7px;">
            <div class="input-group">
              <!--<span class="input-group-addon" style="border:none; background:transparent;">
                <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $i . '" value="' . $objResult1['id_catagory'] . '">
              </span>-->
              <span class="input-group-addon ch-icon" style="border:none; background:transparent; cursor:pointer;" data-id="' . $objResult1['id_catagory'] . '">';
		if ($objResult1['icon'] == '') {
			$output .= '<i class="fa fa-file-picture-o"></i>';
		} else {
			$output .= $objResult1['icon'];
		}
		$output .= '
              </span>
              <span style="font-size:16px;"> <a href="#" data-id="' . $objResult1['id_catagory'] . '" style="color:gray;" class="edit-catagory">' . $objResult1["name_catagory"] . '</a></span>
              <div class="btn-group pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white;" data-id="' . $objResult1['id_catagory'] . '"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-default delete-catagory btn-sm" data-id="' . $objResult1['id_catagory'] . '"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            </div>
            <div class="row" style="display:none;">
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon" style="border:none; background:transparent;">
                    <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $i . '" value="' . $objResult1['id_catagory'] . '">
                  </span>
                  <input type="text" class="form-control updateCat" value="' . $objResult1["name_catagory"] . '" style="border:none; background: transparent;" data-id="' . $objResult1['id_catagory'] . '">
                </div>
              </div>
            <div class="col-md-3">
              <input type="text" class="form-control updateCat_en" value="' . $objResult1["name_catagory_en"] . '" style="border:none; background: transparent;" data-id="' . $objResult1['id_catagory'] . '" data-en="en">
            </div>
            <div class="col-md-3">
              <select class="form-control updateCat_sub pull-right" name="menu_sub" style="border:1px solid #f4f4f4; border-radius:4px; height:30px; padding-top:5px;">
                <option value="0-0-' . $objResult1['id_catagory'] . '">หมวดหมู่หลัก</option>';
		$output .= ' 
                  </select>
                </div>
                <div class="col-md-2 pull-right">
                  <div class="btn-group" style="width:100%;">
                    <div class="btn-group pull-right">
                      <button type="button" class="btn btn-default edit-catagory" style="background-color: white;" data-id="' . $objResult1['id_catagory'] . '"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-default delete-catagory" data-id="' . $objResult1['id_catagory'] . '"><i class="fa fa-remove"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
  ';
//-------------------------------------------------------------------------------------------sub 3------------------------------------------------------------------------------------
		$strSQL2 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '" . $objResult1['id_catagory'] . "'";
		$objQuery2 = mysqli_query($objConnect , $strSQL2);
		while ( $objResult2 = mysqli_fetch_array($objQuery2) ) {
			$i++;
			$output .= '
            <div style="padding-left:45px;">
            <div class="search-text-widget">
            <p style="display:none;">' . $objResult2["name_catagory"] . '</p>
              <div class="box box-warning box-solid" style="padding:7px;">
                <div class="input-group">
                  <!--<span class="input-group-addon" style="border:none; background:transparent;">
                    <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $i . '" value="' . $objResult2['id_catagory'] . '">
                  </span>-->
                  <span class="input-group-addon ch-icon" style="border:none; background:transparent;" data-id="' . $objResult2['id_catagory'] . '">';
			if ($objResult2['icon'] == '') {
				$output .= '<i class="fa fa-file-picture-o"></i>';
			} else {
				$output .= $objResult2['icon'];
			}
			$output .= '                  </span>
                  <span style="font-size:16px;">' . $objResult2["name_catagory"] . '</span>
                  <div class="btn-group pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default edit-catagory btn-sm" style="background-color: white;" data-id="' . $objResult2['id_catagory'] . '"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-default delete-catagory btn-sm" data-id="' . $objResult2['id_catagory'] . '"><i class="fa fa-remove"></i></button>
                    </div>
                  </div>
                </div>
                <div class="row" style="display:none;">
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon" style="border:none; background:transparent;">
                        <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $i . '" value="' . $objResult2['id_catagory'] . '">
                      </span>
                      <input type="text" class="form-control updateCat" value="' . $objResult2["name_catagory"] . '" style="border:none; background: transparent;" data-id="' . $objResult2['id_catagory'] . '">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control updateCat_en" value="' . $objResult2["name_catagory_en"] . '" style="border:none; background: transparent;" data-id="' . $objResult2['id_catagory'] . '" data-en="en">
                  </div>
                  <div class="col-md-3">
                    <select class="form-control updateCat_sub" name="menu_sub" style="border:1px solid #f4f4f4;">
                      <option value="0-0-' . $objResult2['id_catagory'] . '">หมวดหมู่หลัก</option>';
			$output .= '    </select>
                  </div>
                <div class="col-md-3 pull-right">
                  <div class="btn-group" style="width:100%">
                    <div class="btn-group pull-right">  
                      <button type="button" class="btn btn-default edit-catagory" style="background-color: white;" data-id="' . $objResult2['id_catagory'] . '"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-default delete-catagory" data-id="' . $objResult2['id_catagory'] . '"><i class="fa fa-remove"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
		}
	}
	$output .= '
      </div>';
}
$output .= '
		<input type="hidden" name="hdnCount" value="' . $i . '">
		';
echo $output;
                