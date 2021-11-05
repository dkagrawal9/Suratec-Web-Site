<?php
require_once '../library/connect.php';
$output = '';
$output .= '        
                <div class="box-body" style="padding-bottom:0; padding-left:0; padding-right:0;">
                  <div class="form-group" style="margin-bottom:0; padding:10px; padding-top:0px;">
                    <div>
                      <label>ชื่อหมวดหมู่</label>
                      <div class="nav-tabs-custom" style="box-shadow: none;">
                        <ul class="nav nav-tabs">
                          <li class="active">
                            <a href="#thai" data-toggle="tab" aria-expanded="true">
                              <img class="flag-lang" src="../image-folder/th-fl.png" width="22" height="15">
                              ภาษาไทย
                            </a>
                          </li>
                          <li>
                            <a href="#english" data-toggle="tab" aria-expanded="false">
                              <img class="flag-lang" src="../image-folder/en-fl.jpg" width="22" height="15">
                              ภาษาอังกฤษ
                            </a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="thai">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control" placeholder="ภาษาไทย" name="name" id="name_cat" onkeyup="checklength()">
                            </div>
                          </div>
                          <div class="tab-pane" id="english">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_en" id="name_cat_en" onkeyup="checklength()">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p id="validation_name" style="padding: 5px; padding-top:2px; color:orange; display: none;">ชื่อหมวดหมู่</p>
                    
                    <div id="product_catagory" style="padding: 5px;">
                      <label>จัดไว้ใต้หมวดหมู่</label>
                      <select class="form-control" id="sub_catagory">
                        <option value="0">--เป็นหมวดหมู่หลัก--</option>';          
$strSQL = "SELECT * FROM product_catagory WHERE level = '1'";
$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
while($objResult = mysqli_fetch_array($objQuery))
    {
$output .= '<option value="1-'.$objResult["id_catagory"].'">'.$objResult["name_catagory"].'</option>
            ';
      $strSQL1 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$objResult['id_catagory']."'";
      $objQuery1 = mysqli_query($objConnect,$strSQL1) or die (mysqli_error());
      while($objResult1 = mysqli_fetch_array($objQuery1))
          {
      $output .= '<option value="2-'.$objResult1["id_catagory"].'">- '.$objResult1["name_catagory"].'</option>
                  ';
                  $strSQL2 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$objResult1['id_catagory']."'";
                  $objQuery2 = mysqli_query($objConnect,$strSQL2) or die (mysqli_error());
                  while($objResult2 = mysqli_fetch_array($objQuery2))
                      {
                  $output .= '<option value="'.$objResult2["id_catagory"].'" disabled>&nbsp;&nbsp;- '.$objResult2["name_catagory"].'</option>
                              ';
                      }
          }
    }
$output .= '    
            </select>
            </div>
              
            </div>
              ';
$output .= '
              <div class="box-footer">
                  <button type="button" class="btn btn-info btnSendAdd pull-right" id="btnSendAdd" style="margin-right: 5px; transition: 0.4s;" disabled>
                    <i class="fa fa-check"></i>&nbsp;บันทึก
                  </button>
                  <button type="button" class="btn btn-warning btnSendClear pull-right" style="margin-right: 5px;">
                    <i class="fa fa-remove"></i>&nbsp;เคลียร์
                  </button>
              </div>
              ';
echo $output;
?>