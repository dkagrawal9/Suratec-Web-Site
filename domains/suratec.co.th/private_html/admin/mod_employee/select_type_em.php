<?php 
require_once '../library/connect.php';  
if (isset($_GET["role"]) && $_GET["role"]!='0') {
  

       $str1 = "SELECT * FROM `role` WHERE `role_id` = '".$_GET["role"]."'";
    $query1 = mysqli_query($objConnect,$str1);
    $result1 = mysqli_fetch_array($query1);
    $rest = substr($result1["task_view"], 0, -1); 
  $arr_task_view = explode(",", $rest); 

  $rest1 = substr($result1["task_authen"], 0, -1); 
  $arr_task_authen = explode(",", $rest1);
  ?> 

<div class="box-box-center" style="width: 100%; max-width: 100%; text-align: left">
                    <span style="font-size: 18px; font-weight: bold; padding-left: 20px;">สิทธิ์ในการมองเห็น</span>
                    <hr style="margin-top: 10px; margin-bottom: 10px">
                    <div class="tab_sysetem" style="<?php echo $task_manage ?>">
                      <div class="col-lg-6">
                        <span class="btn btn-default btn-block btn-info text_general" id="general_type"><?=CONTENT?></span>
                      </div>
                      <div class="col-lg-6">
                        <span class="btn btn-default btn-block" id="system_type"><?=DESIGN?></span>
                      </div>
                      <!-- <div class="col-lg-4">
                        <span class="btn btn-default btn-block" id="pos"><?=POS?></span>
                      </div> -->
                    </div>
                    <div class="row" style="padding: 15px; <?php echo $task_manage ?>">
                      <div class="col-md-12" id="general_show" style="margin-top: 10px;">
                        <div class="box box-info box-solid">
                          <div class="box-header ">
                            <h3 class="box-title">จัดการเนื้อหา</h3>
                          </div>
                          <div class="box-body">
<table width="100%" >
                             
                              <tbody >
<?php
  $str = "SELECT * FROM system WHERE type = '1' AND level = '1'";
  $query = mysqli_query($objConnect,$str);
  $output = '';
  $i = 0;

  while ($objResult = mysqli_fetch_array($query)) {
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon = $objResult['icon'];
  }
  $i++;


    $output .= '<tr>
                  <td>
                    <div class="form-group">
                      <label style="cursor:pointer; font-weight:normal !important;">
                       
                          '.$icon.'
                          &nbsp;'.$objResult["name_system"].'
                      </label> 
                                
                    </div>
                  </td>
                  <td>
                    <div style="float:right">


					  <label><span class="btn btn-default set_authen authen'.$i.' ';
             for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                            
                                                          }
                                                          
                                                        }
            $output .= '"  data-id="'.$i.'">Manage 
                         <input type="radio" ';
                          for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                      $output .= ' name="general'.$i.'" value="1,'.$objResult["id_system"].'" style="display:none;" > </span></label>
                    
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write 
                             <input type="radio" name="general'.$i.'" value="2,'.$objResult["id_system"].'" style="display:none;"> </span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read 
                             <input type="radio" name="general'.$i.'" value="3,'.$objResult["id_system"].'" style="display:none;"> </span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.' ';
             for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                            
                                                          }
                                                          
                                                        }
            $output .= '" data-id="'.$i.'">Disable 
                             <input type="radio" name="general'.$i.'" value="0,'.$objResult["id_system"].'"  ';
                          for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                      $output .= 'style="display:none;" > </span></label>
                    </div>
                  </td>
                ';      
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
  $strSQL2 = "SELECT * FROM system WHERE level ='2' AND groups = '".$objResult['id_system']."'";
  $objQuery2 = mysqli_query($objConnect,$strSQL2);
  while ($objResult2 = mysqli_fetch_array($objQuery2)) {      
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }
  $i++;
  $output .= '
              <tr>
                  <td>
                      <div class="form-group" style="padding-left:25px;">
                      <label style="cursor:pointer; font-weight:normal !important;">
           

                      '.$icon2.'
                      &nbsp;'.$objResult2["name_system"].'
                      </label>
                      
                      </div>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen authen'.$i.'';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '      " data-id="'.$i.'">Manage
                        <input type="radio" name="general'.$i.'" checked value="1,'.$objResult2["id_system"].'"  ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' value="1,'.$objResult2["id_system"].'"  style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write
                        <input type="radio" name="general'.$i.'" value="2,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read
                        <input type="radio" name="general'.$i.'" value="3,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= ' " data-id="'.$i.'">Disable
                        <input type="radio" name="general'.$i.' " value="0,'.$objResult2["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' style="display:none;"></span></label>
                    </div>
                  </td>   
                   
                  '; 
//------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
    $strSQL3 = "SELECT * FROM system WHERE level ='3' AND groups = '".$objResult2['id_system']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
    while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
    if($objResult3['icon']==''){
      $icon3 = '<i class="fa fa-circle-o text-yellow"></i>';
    }else{
      $icon3 = $objResult3['icon'];
    }
    $i++;   
    $output .= '<tr>
                  <td>
             <div class="form-group" style="padding-left:50px;">
                        <label style="cursor:pointer; font-weight:normal !important;">
                           

                        '.$icon3.'   
                        &nbsp;'.$objResult3["name_system"].'
                        </label>
                        
                         </div>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                           <label><span class="btn btn-default set_authen authen'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Manage 
                              <input type="radio" name="general'.$i.'" checked value="1,'.$objResult3["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' name="general'.$i.'" value="1,'.$objResult3["id_system"].'"  style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write 
                              <input type="radio" name="general'.$i.'" value="2,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read 
                              <input type="radio" name="general'.$i.'" value="3,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Disable 
                              <input type="radio" name="general'.$i.'" value="0,'.$objResult3["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' style="display:none;"></span></label>
                        </div> 
                     </td>
                    </tr>   
                     
                    '; 
     }
  }     
}
$output .=' <input id="count_general" type="hidden" value="'.$i.'" name="count_general">';
echo $output;
?>                  
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12" id="system_show" style="display: none; margin-top: 10px;">
                        <div class="box box-warning box-solid">
                          <div class="box-header">
                            <h3 class="box-title">ออกแบบหน้าเว็บ</h3>
                          </div>
                          <div class="box-body">
                            <table width="100%">
                              <tbody>
<?php
  $str = "SELECT * FROM system WHERE type = '2' AND level = '1'";
  $query = mysqli_query($objConnect,$str);
  $output = '';
  $i = 0;
  while ($objResult = mysqli_fetch_array($query)) {
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon = $objResult['icon'];
  }   
  $i++;
    $output .= '<tr>
                  <td>
         <div class="form-group">
                    <label style="cursor:pointer; font-weight:normal !important;">
                       
                    '.$icon.'
                    &nbsp;'.$objResult["name_system"].'
                    </label>
                  
                  </div>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Manage 
                            <input type="radio" name="system'.$i.'" checked value="1,'.$objResult["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' name="system'.$i.'" value="1,'.$objResult["id_system"].'"  style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                            <input type="radio" name="system'.$i.'" value="2,'.$objResult["id_system"].'" style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                            <input type="radio" name="system'.$i.'" value="3,'.$objResult["id_system"].'" style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Disable 
                            <input type="radio" name="system'.$i.'" value="0,'.$objResult["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' style="display:none;"></span></label>
                    </div>
                  </td>
                </tr>   
                ';      
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
  $strSQL2 = "SELECT * FROM system WHERE level ='2' AND groups = '".$objResult['id_system']."'";
  $objQuery2 = mysqli_query($objConnect,$strSQL2);
  while ($objResult2 = mysqli_fetch_array($objQuery2)) {   
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }   
  $i++;
  $output .= '
  <tr>
    <td>
           <div class="form-group" style="padding-left:25px;">
                      <label style="cursor:pointer; font-weight:normal !important;">
                          
                      '.$icon2.'
                      &nbsp;'.$objResult2["name_system"].'
                 
                      </label>
                    </div>
                    </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Manage 
                        <input type="radio" name="system'.$i.'" checked value="1,'.$objResult2["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' name="system'.$i.'" value="1,'.$objResult2["id_system"].'"  style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                        <input type="radio" name="system'.$i.'" value="2,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                        <input type="radio" name="system'.$i.'" value="3,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Disable 
                        <input type="radio" name="system'.$i.'" value="0,'.$objResult2["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult2["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= '  style="display:none;"></span></label>
                    </div>
                  </td> 
              </tr> 
                  '; 
// ------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
    $strSQL3 = "SELECT * FROM system WHERE level ='3' AND groups = '".$objResult2['id_system']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
    while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
    if($objResult3['icon']==''){
      $icon3 = '<i class="fa fa-circle-o text-yellow"></i>';
    }else{
      $icon3 = $objResult3['icon'];
    }
    $i++;   
    $output .= '
    <tr>
      <td>
             <div class="form-group" style="padding-left:50px;">
                        <label style="cursor:pointer; font-weight:normal !important;">
                           
                        '.$icon3.'   
                        &nbsp;'.$objResult3["name_system"].'
       
                        </label>
                      </div>
                      </td>
                  <td>

                         ';
                        
                  $output .= '  <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Manage 
                        <input type="radio" name="system'.$i.'" checked value="1,'.$objResult3["id_system"].'"  ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]=='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' name="system'.$i.'" value="1,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                        <input type="radio" name="system'.$i.'" value="2,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                        <input type="radio" name="system'.$i.'" value="3,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' ';
                      for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' authen_acitve-block ';
                                                          }
                                                          
                                                        }
                $output .= '" data-id="'.$i.'">Disable 
                        <input type="radio" name="system'.$i.'" value="0,'.$objResult3["id_system"].'" ';
                         for ($x=0; $x < count($arr_task_authen); $x++) { 
                                                          if ($objResult3["id_system"]==$arr_task_view[$x] && $arr_task_authen[$x]!='1') {
                                                 $output .= ' checked ';
                                                         
                                                          }
                                                          
                                                        }
                $output .= ' style="display:none;"></span></label>
                    </div>
                  </td>   
                </tr>
                    '; 
     }
  }     
 }
$output .=' <input id="count_cat_design" type="hidden" value="'.$i.'" name="count_system">';
echo $output;
?>      
 </tbody>
                            </table>      
                            </div></div></div></div></div>

<?php }else{
?>
 <div class="box-box-center" style="width: 100%; max-width: 100%; text-align: left">
                    <span style="font-size: 18px; font-weight: bold; padding-left: 20px;">สิทธิ์ในการมองเห็น</span>
                    <hr style="margin-top: 10px; margin-bottom: 10px">
                    <div class="tab_sysetem" style="<?php echo $task_manage ?>">
                      <div class="col-lg-6">
                        <span class="btn btn-default btn-block btn-info text_general" id="general"><?=CONTENT?></span>
                      </div>
                      <div class="col-lg-6">
                        <span class="btn btn-default btn-block" id="system"><?=DESIGN?></span>
                      </div>
                      <!-- <div class="col-lg-4">
                        <span class="btn btn-default btn-block" id="pos"><?=POS?></span>
                      </div> -->
                    </div>
                    <div class="row" style="padding: 15px; <?php echo $task_manage ?>">
                      <div class="col-md-12" id="general_show" style="margin-top: 10px;">
                        <div class="box box-info box-solid">
                          <div class="box-header ">
                            <h3 class="box-title">จัดการเนื้อหา</h3>
                          </div>
                          <div class="box-body">

                            <table width="100%" >
                             
                              <tbody >
                                
   



<?php
  $str = "SELECT * FROM system WHERE type = '1' AND level = '1'";
  $query = mysqli_query($objConnect,$str);
  $output = '';
  $i = 0;

  while ($objResult = mysqli_fetch_array($query)) {
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon = $objResult['icon'];
  }
  $i++;


    $output .= '<tr>
                  <td>
                    <div class="form-group">
                      <label style="cursor:pointer; font-weight:normal !important;">
                       
                          '.$icon.'
                          &nbsp;'.$objResult["name_system"].'
                      </label> 
                                
                    </div>
                  </td>
                  <td>
                    <div style="float:right">
                     <label><span class="btn btn-default set_authen authen'.$i.' "  data-id="'.$i.'">Manage 
                             <input type="radio" name="general'.$i.'" checked="" value="1,'.$objResult["id_system"].'" style="display:none;" > </span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write 
                             <input type="radio" name="general'.$i.'" value="2,'.$objResult["id_system"].'" style="display:none;"> </span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read 
                             <input type="radio" name="general'.$i.'" value="3,'.$objResult["id_system"].'" style="display:none;"> </span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.' authen_acitve-block" data-id="'.$i.'">Disable 
                             <input type="radio" name="general'.$i.'" value="0,'.$objResult["id_system"].'" checked style="display:none;" > </span></label>
                    </div>
                  </td>
                ';      
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
  $strSQL2 = "SELECT * FROM system WHERE level ='2' AND groups = '".$objResult['id_system']."'";
  $objQuery2 = mysqli_query($objConnect,$strSQL2);
  while ($objResult2 = mysqli_fetch_array($objQuery2)) {      
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }
  $i++;
  $output .= '
              <tr>
                  <td>
                      <div class="form-group" style="padding-left:25px;">
                      <label style="cursor:pointer; font-weight:normal !important;">
           

                      '.$icon2.'
                      &nbsp;'.$objResult2["name_system"].'
                      </label>
                      
                      </div>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Manage
                        <input type="radio" name="general'.$i.'" checked value="1,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write
                        <input type="radio" name="general'.$i.'" value="2,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read
                        <input type="radio" name="general'.$i.'" value="3,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen authen'.$i.' authen_acitve-block" data-id="'.$i.'">Disable
                        <input type="radio" name="general'.$i.'" value="0,'.$objResult2["id_system"].'" checked style="display:none;"></span></label>
                    </div>
                  </td>   
                   
                  '; 
//------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
    $strSQL3 = "SELECT * FROM system WHERE level ='3' AND groups = '".$objResult2['id_system']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
    while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
    if($objResult3['icon']==''){
      $icon3 = '<i class="fa fa-circle-o text-yellow"></i>';
    }else{
      $icon3 = $objResult3['icon'];
    }
    $i++;   
    $output .= '<tr>
                  <td>
             <div class="form-group" style="padding-left:50px;">
                        <label style="cursor:pointer; font-weight:normal !important;">
                           

                        '.$icon3.'   
                        &nbsp;'.$objResult3["name_system"].'
                        </label>
                        
                         </div>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                           <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Manage 
                              <input type="radio" name="general'.$i.'" checked value="1,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Write 
                              <input type="radio" name="general'.$i.'" value="2,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.'" data-id="'.$i.'">Read 
                              <input type="radio" name="general'.$i.'" value="3,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                           <label><span class="btn btn-default set_authen authen'.$i.' authen_acitve-block" data-id="'.$i.'">Disable 
                              <input type="radio" name="general'.$i.'" value="0,'.$objResult3["id_system"].'" checked style="display:none;"></span></label>
                        </div> 
                     </td>
                    </tr>   
                     
                    '; 
     }
  }     
}
$output .=' <input id="count_general" type="hidden" value="'.$i.'" name="count_general">';
echo $output;
?>                  
                              </tbody>
                            </table>
                          </div>
                           </div>
                        </div>
                      </div>
                      <div class="col-md-12" id="system_show" style="display: none; margin-top: 10px;">
                        <div class="box box-warning box-solid">
                          <div class="box-header">
                            <h3 class="box-title">ออกแบบหน้าเว็บ</h3>
                          </div>
                          <div class="box-body">
                            <table width="100%">
                              <tbody>
<?php
  $str = "SELECT * FROM system WHERE type = '2' AND level = '1'";
  $query = mysqli_query($objConnect,$str);
  $output = '';
  $i = 0;
  while ($objResult = mysqli_fetch_array($query)) {
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon = $objResult['icon'];
  }   
  $i++;
    $output .= '<tr>
                  <td>
         <div class="form-group">
                    <label style="cursor:pointer; font-weight:normal !important;">
                       
                    '.$icon.'
                    &nbsp;'.$objResult["name_system"].'
                    </label>
                  
                  </div>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Manage 
                            <input type="radio" name="system'.$i.'" checked value="1,'.$objResult["id_system"].'" style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                            <input type="radio" name="system'.$i.'" value="2,'.$objResult["id_system"].'" style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                            <input type="radio" name="system'.$i.'" value="3,'.$objResult["id_system"].'" style="display:none;"></span></label>
                          <label><span class="btn btn-default set_authen_d authen_d'.$i.' authen_acitve-block" data-id="'.$i.'">Disable 
                            <input type="radio" name="system'.$i.'" value="0,'.$objResult["id_system"].'" checked style="display:none;"></span></label>
                    </div>
                  </td>
                </tr>   
                ';      
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
  $strSQL2 = "SELECT * FROM system WHERE level ='2' AND groups = '".$objResult['id_system']."'";
  $objQuery2 = mysqli_query($objConnect,$strSQL2);
  while ($objResult2 = mysqli_fetch_array($objQuery2)) {   
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }   
  $i++;
  $output .= '
  <tr>
    <td>
           <div class="form-group" style="padding-left:25px;">
                      <label style="cursor:pointer; font-weight:normal !important;">
                          
                      '.$icon2.'
                      &nbsp;'.$objResult2["name_system"].'
                 
                      </label>
                    </div>
                    </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Manage 
                        <input type="radio" name="system'.$i.'" checked value="1,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                        <input type="radio" name="system'.$i.'" value="2,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                        <input type="radio" name="system'.$i.'" value="3,'.$objResult2["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' authen_acitve-block" data-id="'.$i.'">Disable 
                        <input type="radio" name="system'.$i.'" value="0,'.$objResult2["id_system"].'" checked style="display:none;"></span></label>
                    </div>
                  </td> 
              </tr> 
                  '; 
// ------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
    $strSQL3 = "SELECT * FROM system WHERE level ='3' AND groups = '".$objResult2['id_system']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
    while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
    if($objResult3['icon']==''){
      $icon3 = '<i class="fa fa-circle-o text-yellow"></i>';
    }else{
      $icon3 = $objResult3['icon'];
    }
    $i++;   
    $output .= '
    <tr>
      <td>
             <div class="form-group" style="padding-left:50px;">
                        <label style="cursor:pointer; font-weight:normal !important;">
                           
                        '.$icon3.'   
                        &nbsp;'.$objResult3["name_system"].'
       
                        </label>
                      </div>
                      </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Manage 
                        <input type="radio" name="system'.$i.'" checked value="1,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Write 
                        <input type="radio" name="system'.$i.'" value="2,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.'" data-id="'.$i.'">Read 
                        <input type="radio" name="system'.$i.'" value="3,'.$objResult3["id_system"].'" style="display:none;"></span></label>
                      <label><span class="btn btn-default set_authen_d authen_d'.$i.' authen_acitve-block" data-id="'.$i.'">Disable 
                        <input type="radio" name="system'.$i.'" value="0,'.$objResult3["id_system"].'" checked style="display:none;"></span></label>
                    </div>
                  </td>   
                </tr>
                    '; 
     }
  }     
 }
$output .=' <input id="count_cat_design" type="hidden" value="'.$i.'" name="count_system">';
echo $output;
?>            
                            
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <?php
} ?>
                   